<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MultiTenantModelTrait;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentUpload extends Model
{
    use HasFactory,SoftDeletes,Auditable;
    Protected $table = 'document_uploads';
    protected $fillable = ['user_id','session_master_id','document_id','document_code','document_type','document_lock','is_active','document_approval','document_approval_by','document_remark','document_approval_at'];
}

