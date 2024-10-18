@extends('layouts.app')

@section('template_title')
    {{ $usuario->name ?? __('Show') . " " . __('Usuario') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('usuarios.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                       
                        <div class="mb-3">
                            <strong>Nombre:</strong>
                            {{ $usuario->nombres }}
                        </div>
                        <div class="mb-3">
                            <strong>Apellidos:</strong>
                            {{ $usuario->apellidos }}
                        </div>
                        <div class="mb-3">
                            <strong>Dui:</strong>
                            {{ $usuario->dui }}
                        </div>
                        

                        <div class="mb-3">
                            <strong>Dirección:</strong>
                            {{ $usuario->direccion }}
                        </div>

                       
                        <div class="mb-3">
                            <strong>Rol:</strong>
                            {{ $usuario->rol->rol }}
                        </div>
                        <div class="mb-3">
                            <strong>Telefono:</strong>
                            {{ $usuario->telefono }}
                        </div>
                        <div class="mb-3">
                            <strong>Correo:</strong>
                            {{ $usuario->email }}
                        </div>
                        
                        
                        <div class="mb-3">
                            <strong>Usuario:</strong>
                            {{ $usuario->usuario }}
                        </div>
                        <div class="mb-3">
                            <strong>Estado:</strong>
                            {{ $usuario->estado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
