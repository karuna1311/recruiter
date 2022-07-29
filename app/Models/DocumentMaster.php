<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentMaster extends Model
{
    use HasFactory;
    Protected $table = 'document_masters';
    public function documentUpload()
    {
        return $this->hasOne(DocumentUpload::class,'id','document_id');
    }
}

