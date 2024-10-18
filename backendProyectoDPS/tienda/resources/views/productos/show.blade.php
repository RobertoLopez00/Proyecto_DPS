@extends('layouts.app')

@section('template_title')
    {{ $usuario->name ?? __('Show') . " " . __('Rol') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('productos.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                       
                        <div class="mb-3">
                            <strong>Producto:</strong>
                            {{ $producto->producto }}
                        </div>

                        <div class="mb-3">
                            <strong>Descripción:</strong>
                            {{ $producto->descripcion}}
                        </div>

                        <div class="mb-3">
                            <strong>Código:</strong>
                            {{ $producto->codigo }}
                        </div>

                        <div class="mb-3">
                            <strong>Existencias:</strong>
                            {{ $producto->existencias }}
                        </div>

                        <div class="mb-3">
                            <strong>Imagen:</strong>
                            <br>
                          <img width="100px" height="100px"  src="{{asset('img/'. $producto->imagen)}}" alt="">
                        </div>

                        <div class="mb-3">
                            <strong>Categoría:</strong>
                            {{ $producto->categoria->categoria}}
                        </div>

                        <div class="mb-3">
                            <strong>Precio:</strong>
                            {{ $producto->precio }}
                        </div>

                        
                        
                        
                        <div class="mb-3">
                            <strong>Estado:</strong>
                            {{ $producto->estado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
