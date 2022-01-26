<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model{
    use HasFactory;
    protected $table = 'documents';

    public function doc_flow(){
        return $this->belongsTo(DocumentFlow::class,'doc_flow');
    }
    public function doc_flows(){
        return $this->belongsTo(Flows::class,'doc_flow','flow_id');
    }
    public function files(){
        return $this->hasOne(Files::class);
    }
    public function documentlogs(){
        return $this->hasOne(DocumentLogs::class);
    }
}
