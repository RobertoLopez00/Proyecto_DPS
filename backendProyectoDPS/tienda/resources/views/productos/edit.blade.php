@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Usuario
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Actualizar productos') }}
                            </span>

                            <div class="float-right">
                                <a class="btn btn-primary" href="{{ route('productos.index') }}"> {{ __('Regresar') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('productos.update', $producto->id) }}" role="form"
                            enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf
                            <div class="mb-3">

                                <label for="codigo">Código: </label>
                                <input value="{{ $producto->codigo }}" type="text" name="codigo" class="form-control"
                                    placeholder="Código" required>

                                {!! $errors->first('codigo', '<div class="invalid-feedback">:message</div>') !!}

                            </div>
                            <div class="mb-3">

                                <label for="producto">Producto: </label>
                                <input value="{{ $producto->producto }}" type="text" name="producto" class="form-control"
                                    placeholder="Producto" required>

                                {!! $errors->first('producto', '<div class="invalid-feedback">:message</div>') !!}

                            </div>

                            <div class="mb-3">

                                <label for="descripcion">Descripción: </label>
                                <input value="{{ $producto->descripcion }}" type="text" name="descripcion"
                                    class="form-control" placeholder="Descripción" required>

                                {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}

                            </div>

                            <div class="mb-3">

                                <label for="existencias">Existencias: </label>
                                <input value="{{ $producto->existencias }}" type="text" name="existencias"
                                    class="form-control" placeholder="Existencias" required>

                                {!! $errors->first('existencias', '<div class="invalid-feedback">:message</div>') !!}

                            </div>

                            <div class="mb-3">

                                <label for="modelo">Modelo: </label>
                                <input value="{{$producto->modelo}}" type="text" name="modelo" class="form-control" placeholder="Modelo  (OPCIONAL)">
    
                                {!! $errors->first('modelo', '<div class="invalid-feedback">:message</div>') !!}
    
                            </div>
    
                            <div class="mb-3">
    
                                <label for="marca">Marca: </label>
                                <input value="{{$producto->marca}}" type="text" name="marca" class="form-control" placeholder="Marca  (OPCIONAL)">
    
                                {!! $errors->first('marca', '<div class="invalid-feedback">:message</div>') !!}
    
                            </div>
    
                            

                            <div class="mb-3">

                                <label for="precio">Precio: </label>
                                <input value="{{ $producto->precio }}" type="text" name="precio" class="form-control"
                                    placeholder="Precio" required>

                                {!! $errors->first('precio', '<div class="invalid-feedback">:message</div>') !!}

                            </div>

                            <div class="mb-3">

                                <label for="descuento">Descuento: </label>
                                <input value="{{$producto->descuento}}" type="text" name="descuento" class="form-control" placeholder="Descuento (OPCIONAL)">
    
                                {!! $errors->first('descuento', '<div class="invalid-feedback">:message</div>') !!}
    
                            </div>

                            <div class="mb-3">

                                <label for="id_categoria">Categoría: </label>
                                <select name="id_categoria" class="form-select" id="id_categoria"
                                    aria-label="Default select example" required>
                                    <option selected="true" disabled="disabled">Seleccione un categoría</option>
                                    @foreach ($categorias as $categoria)
                                        @if ($categoria->id == $producto->categoria->id)
                                            <option selected value="{{ $categoria->id }}">{{ $categoria->categoria }}
                                            </option>
                                        @else
                                            <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                {!! $errors->first('id_categoria', '<div class="invalid-feedback">:message</div>') !!}

                            </div>

                            

                            <div class="mb-3">
                                <label for="imagen">Foto: </label>
                                <input name="imagen" accept="image/*" type="file">
                            </div>

                            <div class="mb-3">

                                <label for="estado">Estado</label>
                                <select name="estado" class="form-select" id="estado"
                                    aria-label="Default select example">


                                    @if ($producto->estado == 'Activo')
                                        <option value="Activo" selected>Activo</option>
                                        <option value="Inactivo">Inactivo</option>
                                    @else
                                        <option value="Activo">Activo</option>
                                        <option value="Inactivo" selected>Inactivo</option>
                                    @endif

                                </select>

                                {!! $errors->first('estado', '<div class="invalid-feedback">:message</div>') !!}

                            </div>







                            <div class="box-footer mt20 text-center mb-3">
                                <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
