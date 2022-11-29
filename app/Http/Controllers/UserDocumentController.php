<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User_document;
use App\Models\User_document_redirect;
use App\Http\Services\Helpers\Encoder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Validator;


class UserDocumentController extends Controller
{
    public static function generateDocument($user_uuid, $data_uuid, $name, $type, $url, $save_file=false, $user_document_data=null) {
        $user = User::where('uuid', $user_uuid)->first();

        if ($user) {
            return DB::transaction(function () use ($user, $data_uuid, $name, $type, $url, $save_file, $user_document_data) {
                $user_document = new User_document();
                $user_document->uuid = Uuid::uuid4()->toString();
                $user_document->user_uuid= $user->uuid;
                $user_document->fileName = $name;
                $user_document->documentType = $type;

                $user_document_redirect = new User_document_redirect();
                $user_document_redirect->key = Encoder::base64url_encode_random_bytes();
                $user_document_redirect->user_document_uuid = $user_document->uuid;
                $user_document_redirect->data_uuid = $data_uuid;

                if ($save_file && $user_document_data) {
                    $path = Storage::putFile('documents', $user_document_data);
                    $user_document_redirect->stored_path = $path;
                }

                $file_url = $url;
                $file_url .= '?q='.urlencode($user_document_redirect->key);
                $user_document->fileUrl = $file_url;

                $user_document->save();
                $user_document_redirect->save();
                return $user_document->fileUrl;
            });
        }
    }

    public function fetchStoredDocument(Request $request) {
        $validator = Validator::make($request->all(), [
            'q' => 'required',
        ]);

        if ($validator->fails()) {
            abort(404);
        }

        $document_redirect = User_document_redirect::where('key', urldecode($request->input('q')))->with('document')->first();

        if (!$document_redirect || !$document_redirect->document) {
            abort(404);
        }

        $filename = $document_redirect->document->fileName;
        $headers = array(
            'Content-Disposition' => 'inline; filename="'.$filename.'"',
        );

        return Storage::download($document_redirect->stored_path, $filename, $headers);
    }
}
