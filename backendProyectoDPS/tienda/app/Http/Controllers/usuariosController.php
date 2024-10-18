<?php

namespace App\Http\Controllers;

use App\Models\rol;
use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class usuariosController extends Controller
{
    public function index()
    {
        $usuarios = usuario::all();
        $roles = rol::all();

        return view('usuarios.index', ['usuarios' => $usuarios, 'roles' => $roles]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'dui' => 'required|unique:usuarios|string|size:10',
            'telefono' => 'required|string|size:8',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required',
            'direccion' => 'required',


            'id_rol' => 'required',

            'estado' => 'required',



        ]);

        $usuario = new usuario();
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->dui = $request->dui;
        $usuario->usuario = $request->usuario;


        $usuario->telefono = $request->telefono;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->id_rol = $request->id_rol;

        $usuario->direccion = $request->direccion;
        $usuario->estado = $request->estado;
        $usuario->save();

        return redirect(route('usuarios.index'))->with('success', 'Registro ingresado con éxito');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'dui' => ['required', 'string', 'size:10', Rule::unique('usuarios')->ignore($id)],
            'telefono' => 'required|string|size:8',
            'email' => ['required', Rule::unique('usuarios')->ignore($id)],
            'direccion' => 'required',
            'id_rol' => 'required',


            'estado' => 'required',



        ]);

        $usuario = usuario::find($id);
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->dui = $request->dui;
        $usuario->telefono = $request->telefono;
        $usuario->usuario = $request->usuario;
        $usuario->email = $request->email;
        if (!is_null($request->password)) {
            $usuario->password = Hash::make($request->password);
        }
        if (!is_null($request->password)) {
            $usuario->password = Hash::make($request->password);
        }




        $usuario->id_rol = $request->id_rol;

        $usuario->direccion = $request->direccion;
        $usuario->estado = $request->estado;
        $usuario->save();

        return redirect(route('usuarios.index'))->with('success', 'Registro actualizado con éxito');
    }

    public function edit($id)
    {
        $usuario = usuario::find($id);
        $roles = rol::all();

        return view('usuarios.edit', ['usuario' => $usuario, 'roles' => $roles]);
    }

    public function show($id)
    {
        $usuario = usuario::find($id);
        return view('usuarios.show', ['usuario' => $usuario]);
    }

    public function destroy($id)
    {
        usuario::find($id)->delete();
        return redirect(route('usuarios.index'))->with('success', 'Registro eliminado con éxito');
    }

    public function storeFront(Request $request)
    {

        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'dui' => 'required|unique:usuarios|string|size:10',
            'telefono' => 'required|string|size:8',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required',
            'direccion' => 'required',


           

     



        ]);


        try {
            // Crear un nuevo producto usando los datos validados
            $usuario = new usuario();
            $usuario->nombres = $request->nombres;
            $usuario->apellidos = $request->apellidos;
            $usuario->dui = $request->dui;
            $usuario->usuario = $request->usuario;


            $usuario->telefono = $request->telefono;
            $usuario->email = $request->email;
            $usuario->password = Hash::make($request->password);
            $usuario->id_rol = 2;

            $usuario->direccion = $request->direccion;
            $usuario->estado = "Activo";
            $usuario->save();


            // Devolver una respuesta JSON con un mensaje de éxito
            return response()->json([
                'message' => 'Usuario creado exitosamente',
                'usuario' => $usuario,
            ], 201); // Código 201 para creación exitosa
        } catch (\Exception $e) {
            // En caso de error, devolver un mensaje de error
            return response()->json([
                'message' => 'Error al crear el usuario',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function updateFront(Request $request, $id)
    {
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'dui' => ['required', 'string', 'size:10', Rule::unique('usuarios')->ignore($id)],
            'telefono' => 'required|string|size:8',
            'email' => ['required', Rule::unique('usuarios')->ignore($id)],
            'direccion' => 'required',
           


            'estado' => 'required',



        ]);



        try {
            // Crear un nuevo producto usando los datos validados
            $usuario = usuario::find($id);
            $usuario->nombres = $request->nombres;
            $usuario->apellidos = $request->apellidos;
            $usuario->dui = $request->dui;
            $usuario->telefono = $request->telefono;
            $usuario->usuario = $request->usuario;
            $usuario->email = $request->email;
            if (!is_null($request->password)) {
                $usuario->password = Hash::make($request->password);
            }
            if (!is_null($request->password)) {
                $usuario->password = Hash::make($request->password);
            }




            $usuario->id_rol = 2;

            $usuario->direccion = $request->direccion;
            $usuario->estado = $request->estado;
            $usuario->save();


            // Devolver una respuesta JSON con un mensaje de éxito
            return response()->json([
                'message' => 'Usuario actualizado exitosamente',
                'usuario' => $usuario,
            ], 201); // Código 201 para creación exitosa
        } catch (\Exception $e) {
            // En caso de error, devolver un mensaje de error
            return response()->json([
                'message' => 'Error al actualizar el usuario',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function showFront($id){
        try {
            // Obtener todos los datos del modelo
            $usuario = usuario::find($id);

            // Verificar si se encontraron datos
            if ($usuario == null) {
                return response()->json([
                    'message' => 'No se encontraron datos',
                    'data' => [],
                ], 200); // Código 200 para éxito
            }

            // Si se encuentran datos, devolverlos con un mensaje de éxito
            return response()->json([
                'message' => 'Consulta realizada correctamente',
                'usuario' => $usuario,
            ], 200);
        } catch (\Exception $e) {
            // En caso de error, devolver un mensaje de error y el código de estado 500
            return response()->json([
                'message' => 'Error al realizar la consulta',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
