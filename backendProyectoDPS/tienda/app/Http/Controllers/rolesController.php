<?php

namespace App\Http\Controllers;

use App\Models\rol;
use Illuminate\Http\Request;

class rolesController extends Controller
{
    public function index(){
        $roles = rol::all();
        return view('roles.index', ['roles' => $roles]);
    }

    public function store(Request $request){
        $request->validate([
            'rol' => 'required',
            'estado' => 'required',
        ]);

        $rol = new rol();
        $rol->rol = $request->rol;
        $rol->estado = $request->estado;
        $rol->save();

        return redirect(route('roles.index'))->with('success','Registro ingresado con éxito');

    }

    public function show($id){
        $rol = rol::find($id);
        return view('roles.show', ['rol' => $rol ]);

    }

    public function edit($id){
        $rol = rol::find($id);
        return view('roles.edit', ['rol' => $rol]);

    }

    public function update(Request $request, $id){
        $request->validate([
            'rol' => 'required',
            'estado' => 'required',
        ]);

        $rol = rol::find($id);
        $rol->rol = $request->rol;
        $rol->estado = $request->estado;
        $rol->save();

        return redirect(route('roles.index'))->with('success','Registro actualizado con éxito');
    }

    public function destroy($id){
        rol::find($id)->delete();
        return redirect(route('roles.index'))->with('success','Registro eliminado con éxito');


    }
}
