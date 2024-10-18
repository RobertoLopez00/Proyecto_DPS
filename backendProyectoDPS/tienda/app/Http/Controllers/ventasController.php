<?php

namespace App\Http\Controllers;

use App\Models\compraEstado;
use App\Models\detalle;
use App\Models\producto;
use App\Models\venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ventasController extends Controller
{
    public function index(){
        $ventas = venta::all()->sortByDesc("id");
        return view('ventas.index',['ventas' => $ventas]);
    }

    public function edit($id){
        $venta = venta::find($id);
        $estados = compraEstado::all();

        return view('ventas.edit', ['venta' => $venta, 'estados' => $estados]);
    }

    public function update(Request $request, $id){
        $venta = venta::find($id);
        $venta->id_estado = $request->estado;
        $venta->save();

        return redirect(route('ventas.index'))->with('success', 'Registro actualizado con éxito');
    }

    public function detalles($id){
        $venta = venta::find($id);

        return view('ventas.detalles',['venta' => $venta]);
    }

    public function ingresarVenta(Request $request){
        
        


        try {
            // Crear un nuevo producto usando los datos validados
            $venta = new venta();
            $venta->id_cliente = $request->id_cliente;
            $venta->monto = $request->monto;
            $venta->id_estado = $request->id_estado;
            $venta->direccion = $request->direccion;
            $venta->save();

            foreach($request->items as $item){
                $detalle = new detalle();
                $producto = producto::find($item['producto']);
                $detalle->id_venta = $venta->id;
                $detalle->id_producto = $item['producto'];
                $detalle->cantidad = $item['cantidad'];
                $detalle->monto = $item['cantidad'] * $producto->precio;
                $detalle->save();

            }


            // Devolver una respuesta JSON con un mensaje de éxito
            return response()->json([
                'message' => 'Venta registrada exitosamente',
                'venta' => $venta,
            ], 201); // Código 201 para creación exitosa
        } catch (\Exception $e) {
            // En caso de error, devolver un mensaje de error
            return response()->json([
                'message' => 'Error al ingresar la venta',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    
}
