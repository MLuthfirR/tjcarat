<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserDocumentController;
use App\Models\User;
use App\Models\User_document;
use App\Providers\RouteServiceProvider;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function index()
    {
        $document_types = [
            [
                'text' => 'Akta Pendirian dan Menkumham',
                'value' => 'AKTA_PENDIRIAN_MENKUMHAM',
            ],
            [
                'text' => 'Akta Terakhir dan Menkumham',
                'value' => 'AKTA_TERAKHIR_MENKUMHAM',
            ],
            [
                'text' => 'NPWP & SPPKP',
                'value' => 'NPWP_SPPKP',
            ],
            [
                'text' => 'NIB',
                'value' => 'NIB',
            ],
            [
                'text' => 'SIUPKK / SIUPAL / SIUP',
                'value' => 'SIUPKK_SIUPAL_SIUP',
            ],
            [
                'text' => 'SPT (Last Year)',
                'value' => 'SPT',
            ],
        ];
        $required_documents = json_encode([
            [
                'text' => 'Akta Pendirian dan Menkumham',
                'value' => 'AKTA_PENDIRIAN_MENKUMHAM',
            ],
            [
                'text' => 'Akta Terakhir dan Menkumham',
                'value' => 'AKTA_TERAKHIR_MENKUMHAM',
            ],
            [
                'text' => 'NPWP & SPPKP',
                'value' => 'NPWP_SPPKP',
            ],
            [
                'text' => 'NIB',
                'value' => 'NIB',
            ],
            [
                'text' => 'SIUPKK / SIUPAL / SIUP',
                'value' => 'SIUPKK_SIUPAL_SIUP',
            ],
            [
                'text' => 'SPT (Last Year)',
                'value' => 'SPT',
            ],
        ]);
        return view('pages.auth.register', compact('document_types', 'required_documents'));
    }

    public function registerStore(Request $request)
    {
        $this->validate($request, [
            'company_name' => 'required',
            'email' => 'required',
            'company_phone_number' => 'required|numeric',
            'company_address' => 'required',
            'npwp' => 'required',
            'pic_name' => 'required',
            'pic_title' => 'required',
            'password' => 'required',
        ]);

        $body = [
            'company_name' => $request->input('company_name'),
            'email' => $request->input('email'),
            'company_phone_number' => $request->input('company_phone_number'),
            'company_address' => $request->input('company_address'),
            'npwp' => $request->input('npwp'),
            'pic_name' => $request->input('pic_name'),
            'pic_title' => $request->input('pic_title'),
            'password' => $request->input('password'),
            'documents_meta' => $request->input('documents_meta', []),
            'documents' => $request->file('documents', []),
        ];

        $documents_type = array_map(function ($elmt) {
            $document_meta = is_array($elmt) ? $elmt : json_decode($elmt, true);
            return [
                "documentType" => $document_meta['type'],
            ];
        }, $body['documents_meta']);
        $required_documents = ['AKTA_PENDIRIAN_MENKUMHAM'];

        if (!User_document::isRequiredDocumentsExists($documents_type, $required_documents)) {
            abort(400, "Please upload all required documents");
        }

        $user = new User();
        $user->uuid = Uuid::uuid4()->toString();
        $user->company_name = $body['company_name'];
        $user->email = $body['email'];
        $user->company_phone_number = $body['company_phone_number'];
        $user->company_address = $body['company_address'];
        $user->npwp = $body['npwp'];
        $user->pic_name = $body['pic_name'];
        $user->pic_title = $body['pic_title'];
        $user->password = Hash::make($body['password']);

        DB::transaction(function()
            use ($user, $body) {
            $user->save();
            $user->assignRole('user');

            foreach ($body['documents_meta'] as $index => $document_data) {

                $document_data_attr = is_array($document_data) ? $document_data : json_decode($document_data, true);
                $document_attr = [
                    'filename' => $document_data_attr['filename'],
                    'type' => $document_data_attr['type'],
                    'custom_type' => isset($document_data_attr['custom_type']) ? $document_data_attr['custom_type'] : '',
                ];

                $document_data = $body['documents'][$index];
                UserDocumentController::generateDocument(
                    $user->uuid,
                    null,
                    $document_data->getClientOriginalName(),
                    ($document_attr['type'] != 'Custom') ? $document_attr['type'] : $document_attr['custom_type'],
                    url("/document/get"),
                    true,
                    $document_data
                );
            }
        });

        return response()->json([
            'success' => True,
            'message' => 'User Created',
            'data' => [
                'user_uuid' => $user->uuid,
                'company_name' => $user->company_name,
            ]
        ], 200);
    }
}
