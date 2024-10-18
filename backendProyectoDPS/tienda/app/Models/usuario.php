<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class usuario extends Authenticatable
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'nombres',
        'apellidos',
        'dui',
        
        'telefono',
        'usuario',
        
        'id_rol',
        'email',
        'estado',
        'password',
        'direccion',
        
    ];

    public function rol(){
        return $this->belongsTo(rol::class, 'id_rol', 'id');
    }

   
}
