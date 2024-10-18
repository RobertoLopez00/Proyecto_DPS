<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class venta extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function cliente(){
        return $this->belongsTo(usuario::class, 'id_cliente', 'id');
    }

    public function detalles(){
        return $this->hasMany(detalle::class, 'id_venta', 'id');
    }

    

    public function estado(){
        return $this->belongsTo(compraEstado::class, 'id_estado', 'id');
    }
}
