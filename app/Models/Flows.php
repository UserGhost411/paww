<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flows extends Model
{
    use HasFactory;
    protected $table = 'flows';

    public function document(){
        return $this->belongsTo(DocumentFlow::class,);
    }
    public function actor(){
        return $this->belongsTo(User::class,);
    }
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
    
    
}
