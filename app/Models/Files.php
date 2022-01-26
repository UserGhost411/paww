<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;
    protected $table = 'files';

    public function file_document(){
        return $this->belongsTo(Document::class,);
    }
    public function file_uploader(){
        return $this->belongsTo(User::class,);
    }
}
