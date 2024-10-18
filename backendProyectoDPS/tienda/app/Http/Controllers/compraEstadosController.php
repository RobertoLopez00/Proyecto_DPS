<?php

namespace App\Http\Controllers;

use App\Models\compraEstado;
use Illuminate\Http\Request;

class compraEstadosController extends Controller
{
    public function index(){
        $estados = compraEstado::all();
        return view('compra-estados.index', ['estados' => $estados]);
    }

    public function store(Request $request){
        $request->validate([
            'estado' => 'required',
           
        ]);

        $estado = new compraEstado();
        $estado->estado = $request->estado;
      
        $estado->save();

        return redirect(route('compra-estados.index'))->with('success','Registro ingresado con éxito');

    }

    public function show($id){
        $estado = compraEstado::find($id);
        return view('compra-estados.show', ['estado' => $estado ]);

    }

    public function edit($id){
        $estado = compraEstado::find($id);
        return view('compra-estados.edit', ['estado' => $estado]);

    }

    public function update(Request $request, $id){
        $request->validate([
            'estado' => 'required',
         
        ]);

        $estado = compraEstado::find($id);
        $estado->estado = $request->estado;
      
        $estado->save();

        return redirect(route('compra-estados.index'))->with('success','Registro actualizado con éxito');
    }

    public function destroy($id){
        compraEstado::find($id)->delete();
        return redirect(route('compra-estados.index'))->with('success','Registro eliminado con éxito');


    }
}
