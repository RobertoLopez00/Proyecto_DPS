<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class producto extends Model
{
    use HasFactory;
    public $timestamps = false;

   

   


    public function categoria(){
        return $this->belongsTo(categoria::class, 'id_categoria', 'id');
    }

    
}
