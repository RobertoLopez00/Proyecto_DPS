<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\pregunta;
use App\Models\respuesta;
use App\Models\usuario;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    
}
