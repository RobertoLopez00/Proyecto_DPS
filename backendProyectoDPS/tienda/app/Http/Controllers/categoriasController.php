<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class categoriasController extends Controller
{
    public function index(){
        $categorias = categoria::all();
        return view('categorias.index', ['categorias' => $categorias]);
    }
    
    public function store(Request $request){
        $request->validate([
            'categoria' => 'required',
            
           
        ]);
    
        $categoria = new categoria();
        $categoria->categoria = $request->categoria;
    
    
        $categoria->save();
    
        return redirect(route('categorias.index'))->with('success','Registro ingresado con éxito');
    }
    
    public function show($id){
        $categoria = categoria::find($id);
        return view('categorias.show', ['categoria' => $categoria]);
    }
    
    public function edit($id){
        $categoria = categoria::find($id);
        return view('categorias.edit', ['categoria' => $categoria]);
    }
    
    public function update(Request $request, $id){
        $request->validate([
            'categoria' => 'required',
          
            
        ]);
    
        $categoria = categoria::find($id);
        $categoria->categoria = $request->categoria;
       
       
        $categoria->save();
    
        return redirect(route('categorias.index'))->with('success','Registro actualizado con éxito');
    }
    
    public function destroy($id){
        categoria::find($id)->delete();
        return redirect(route('categorias.index'))->with('success','Registro eliminado con éxito');
    }

    public function showFront(){
        try {
            // Obtener todos los datos del modelo
            $categorias = categoria::all();

            // Verificar si se encontraron datos
            if ($categorias->isEmpty()) {
                return response()->json([
                    'message' => 'No se encontraron datos',
                    'data' => [],
                ], 200); // Código 200 para éxito
            }

            // Si se encuentran datos, devolverlos con un mensaje de éxito
            return response()->json([
                'message' => 'Consulta realizada correctamente',
                'productos' => $categorias,
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
