<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_document_redirect extends Model
{
    use HasFactory;
    public function document() {
        return $this->belongsTo('App\Models\User_document', 'user_document_uuid', 'uuid');
    }
}
