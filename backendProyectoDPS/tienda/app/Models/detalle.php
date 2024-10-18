<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalle extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function venta(){
        return $this->belongsTo(venta::class, 'id_venta', 'id');
    }
    public function producto(){
        return $this->belongsTo(producto::class, 'id_producto', 'id');
    }

   
}
