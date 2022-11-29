<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_document extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid', 'fileName', 'fileUrl','user_uuid','documentType'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_uuid', 'uuid');
    }

    public static function isRequiredDocumentsExists($documents=[], $required_types=[]) {
        foreach ($required_types as $type) {
            foreach ($documents as $document) {
                $exists = false;
                if ($document['documentType'] == $type) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                return false;
            }
        }
        return true;
    }
}
