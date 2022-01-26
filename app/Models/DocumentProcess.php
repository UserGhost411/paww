<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentProcess extends Model
{
    use HasFactory;
    protected $table = 'document_process';

    public function log_document(){
        return $this->belongsTo(Document::class,);
    }
    public function log_actor(){
        return $this->belongsTo(User::class,);
    }
}
