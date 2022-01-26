<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentFlow extends Model
{
    use HasFactory;
    protected $table = 'document_flow';

    public function docflow_category(){
        return $this->belongsTo(DocumentCategory::class,);
    }
    public function documentflows(){
        return $this->hasOne(DocumentFlow::class);
    }
    public function document(){
        return $this->hasOne(Document::class,'doc_flow');
    }
}
