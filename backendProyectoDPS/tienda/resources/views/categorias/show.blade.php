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
                            <a class="btn btn-primary" href="{{ route('categorias.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                       
                        <div class="mb-3">
                            <strong>Categoría:</strong>
                            {{ $categoria->categoria }}
                        </div>
                        
                        
                        <div class="mb-3">
                            <strong>Estado:</strong>
                            {{ $categoria->estado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
