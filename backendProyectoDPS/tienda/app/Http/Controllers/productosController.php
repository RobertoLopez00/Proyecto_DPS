<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use App\Models\producto;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class productosController extends Controller
{
    public function index()
    {
        $productos = producto::all();
        $categorias = categoria::all();
     
        return view('productos.index', [ 'productos' => $productos, 'categorias' => $categorias]);
    }

    

    public function store(Request $request)
    {
        $request->validate([
            'producto' => 'required',
            'descripcion' => 'required',
            'codigo' => 'required',
            'existencias' => 'required',
            'imagen' => 'required',
            'id_categoria' => 'required',
            'modelo' => 'required',
            'marca' => 'required',
           

            'precio' => 'required',
            'estado' => 'required'

        ]);

        $producto = new producto();
        $producto->producto = $request->producto;
        $producto->descripcion = $request->descripcion;
        $producto->codigo = $request->codigo;
       
        $producto->existencias = $request->existencias;
        $producto->id_categoria = $request->id_categoria;
        $producto->estado = $request->estado;
        $producto->precio = $request->precio;
        $producto->modelo = $request->modelo;
        $producto->marca = $request->marca;
      

        
        
        if ($request->descuento != null) {
            $producto->descuento = $request->descuento;
        }


        $nombre = time() . "_" . $request->file('imagen')->getClientOriginalName();
        $producto->imagen = $nombre;
        Storage::disk('img')->put($nombre, File::get($request->file('imagen')));
        $producto->save();

        return redirect(route('productos.index'))->with('success', 'Registro ingresado con éxito');
    }

    public function show($id)
    {
        $producto = producto::find($id);
        return view('productos.show', ['producto' => $producto]);
    }

    public function edit($id)
    {
        $producto = producto::find($id);
        $categorias = categoria::all();
      
        return view('productos.edit', ['producto' => $producto, 'categorias' => $categorias]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'producto' => 'required',
            'descripcion' => 'required',
            'codigo' => 'required',
            'existencias' => 'required',

            'id_categoria' => 'required',
            
            'modelo' => 'required',
            'marca' => 'required',

            'precio' => 'required',
            'estado' => 'required'


        ]);

        $producto = producto::find($id);
        $producto->producto = $request->producto;
        $producto->descripcion = $request->descripcion;
        $producto->codigo = $request->codigo;
        $producto->existencias = $request->existencias;
      
        $producto->id_categoria = $request->id_categoria;
        $producto->estado = $request->estado;
        $producto->precio = $request->precio;
        $producto->modelo = $request->modelo;
        $producto->marca = $request->marca;

       

       
        if ($request->descuento != null) {
            $producto->descuento = $request->descuento;
        }


        if (isset($request->imagen)) {

            $nombre = time() . "_" . $request->file('imagen')->getClientOriginalName();
            Storage::disk('img')->delete($producto->imagen, File::get($request->file('imagen')));
            $producto->imagen = $nombre;
            Storage::disk('img')->put($nombre, File::get($request->file('imagen')));
        }
        $producto->save();

        return redirect(route('productos.index'))->with('success', 'Registro actualizado con éxito');
    }

    public function destroy($id)
    {
        producto::find($id)->delete();
        return redirect(route('productos.index'))->with('success', 'Registro eliminado con éxito');
    }

    public function showFront(){
        try {
            // Obtener todos los datos del modelo
            $productos = producto::all();

            // Verificar si se encontraron datos
            if ($productos->isEmpty()) {
                return response()->json([
                    'message' => 'No se encontraron datos',
                    'data' => [],
                ], 200); // Código 200 para éxito
            }

            // Si se encuentran datos, devolverlos con un mensaje de éxito
            return response()->json([
                'message' => 'Consulta realizada correctamente',
                'productos' => $productos,
            ], 200);
        } catch (\Exception $e) {
            // En caso de error, devolver un mensaje de error y el código de estado 500
            return response()->json([
                'message' => 'Error al realizar la consulta',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function showProductoFront($id){
        try {
            // Obtener todos los datos del modelo
            $producto = producto::find($id);

            // Verificar si se encontraron datos
            if ($producto == null) {
                return response()->json([
                    'message' => 'No se encontraron datos',
                    'data' => [],
                ], 200); // Código 200 para éxito
            }

            // Si se encuentran datos, devolverlos con un mensaje de éxito
            return response()->json([
                'message' => 'Consulta realizada correctamente',
                'producto' => $producto,
            ], 200);
        } catch (\Exception $e) {
            // En caso de error, devolver un mensaje de error y el código de estado 500
            return response()->json([
                'message' => 'Error al realizar la consulta',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function showOfertas(){
        try {
            // Obtener todos los datos del modelo
            $productos = producto::where('descuento', '>', 0)->get();

            // Verificar si se encontraron datos
            if ($productos->isEmpty()) {
                return response()->json([
                    'message' => 'No se encontraron datos',
                    'data' => [],
                ], 200); // Código 200 para éxito
            }

            // Si se encuentran datos, devolverlos con un mensaje de éxito
            return response()->json([
                'message' => 'Consulta realizada correctamente',
                'productos' => $productos,
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
