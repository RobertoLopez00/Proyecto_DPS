<?php

namespace App\Http\Controllers;

use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class autenticarClienteController extends Controller
{
    public function login(Request $request)
    {
        // Validar los campos del formulario
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Buscar el usuario por su email
        $usuario = usuario::where('email', $request->email)->first();

        // Verificar si el usuario existe y si la contraseña es correcta
        if (!$usuario || !Hash::check($request->password, $usuario->password)) {
            return response()->json(['error' => 'Credenciales incorrectas'], 401);
        }

        // Crear un token de autenticación (opcional, si estás usando tokens)
     

        // Devolver el usuario autenticado y el token
        return response()->json([
            'message' => 'Login exitoso',
     
            'usuario' => $usuario,
        ]);
    }
}
