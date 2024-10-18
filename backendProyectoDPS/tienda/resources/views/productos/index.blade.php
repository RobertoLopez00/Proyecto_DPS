@extends('layouts.app')

@section('template_title')
    Usuarios
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Categorías') }}
                            </span>




                            <div class="float-right">


                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" data-placement="left">
                                    {{ __('Crear nuevo registro') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id='Tabla' style="width:100%" class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>


                                        <th>Código</th>
                                        <th>Producto</th>
                                        <th>Descripción</th>
                                        <th>Existencias</th>
                                        <th>Precio</th>
                                        <th>Descuento</th>
                                        <th>Categoría</th>
                                        
                                        <th>Imagen</th>
                                        <th>Marca</th>
                                        <th>Modelo</th>
                                        

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $producto)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $producto->codigo }}</td>

                                            <td>{{ $producto->producto }}</td>
                                            <td>{{ $producto->descripcion }}</td>
                                            <td>{{ $producto->existencias }}</td>
                                            <td>{{ $producto->precio }}</td>
                                            <td>{{ $producto->descuento }} %</td>
                                            <td>{{ $producto->categoria->categoria }}</td>
                                           

                                            <td><img src="{{ asset('img/' . $producto->imagen) }}" width="100px"
                                                    height="100px"></td>
                                            <td>{{ $producto->marca }}</td>
                                            <td>{{ $producto->modelo }}</td>
                              

                                            <td>
                                                <form action="{{ route('productos.destroy', $producto->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('productos.show', $producto->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('productos.edit', $producto->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i></a>
                                                    
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-fw fa-trash"></i> </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end">


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar categoría</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @includeif('partials.errors')

                        @csrf

                        <div class="mb-3">

                            <label for="codigo">Código: </label>
                            <input type="text" name="codigo" class="form-control" placeholder="Código" required>

                            {!! $errors->first('codigo', '<div class="invalid-feedback">:message</div>') !!}

                        </div>
                        <div class="mb-3">

                            <label for="producto">Producto: </label>
                            <input type="text" name="producto" class="form-control" placeholder="Producto" required>

                            {!! $errors->first('producto', '<div class="invalid-feedback">:message</div>') !!}

                        </div>

                        <div class="mb-3">

                            <label for="descripcion">Descripción: </label>
                            <input type="text" name="descripcion" class="form-control" placeholder="Descripción"
                                required>

                            {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}

                        </div>

                        <div class="mb-3">

                            <label for="modelo">Modelo: </label>
                            <input type="text" name="modelo" class="form-control" placeholder="Modelo  ">

                            {!! $errors->first('modelo', '<div class="invalid-feedback">:message</div>') !!}

                        </div>

                        <div class="mb-3">

                            <label for="marca">Marca: </label>
                            <input type="text" name="marca" class="form-control" placeholder="Marca  ">

                            {!! $errors->first('marca', '<div class="invalid-feedback">:message</div>') !!}

                        </div>

                   

                        <div class="mb-3">

                            <label for="existencias">Existencias: </label>
                            <input type="text" name="existencias" class="form-control" placeholder="Existencias"
                                required>

                            {!! $errors->first('existencias', '<div class="invalid-feedback">:message</div>') !!}

                        </div>

                        <div class="mb-3">

                            <label for="precio">Precio: </label>
                            <input type="text" name="precio" class="form-control" placeholder="Precio" required>

                            {!! $errors->first('precio', '<div class="invalid-feedback">:message</div>') !!}

                        </div>

                        <div class="mb-3">

                            <label for="descuento">Descuento: </label>
                            <input type="text" name="descuento" class="form-control"
                                placeholder="Descuento (OPCIONAL)">

                            {!! $errors->first('descuento', '<div class="invalid-feedback">:message</div>') !!}

                        </div>

                        <div class="mb-3">

                            <label for="id_categoria">Categoría: </label>
                            <select name="id_categoria" class="form-select" id="id_categoria"
                                aria-label="Default select example" required>
                                <option selected="true" disabled="disabled">Seleccione un categoría</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                                @endforeach
                            </select>

                            {!! $errors->first('id_categoria', '<div class="invalid-feedback">:message</div>') !!}

                        </div>

                        

                        <div class="mb-3">
                            <label for="imagen">Foto: </label>
                            <input required name="imagen" accept="image/*" type="file">
                        </div>

                        <div class="mb-3">

                            <label for="estado">Estado</label>
                            <select name="estado" class="form-select" id="estado"
                                aria-label="Default select example">
                                <option selected="true" disabled="disabled">Seleccione un estado</option>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                            {!! $errors->first('estado', '<div class="invalid-feedback">:message</div>') !!}

                        </div>







                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
                    </div>

                </div>
            </div>
        </div>
    </form>
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
    <script>
        $('#Tabla').DataTable({
            responsive: true,
            autoWidth: true,

            "language": {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "emptyTable": "Ningún dato disponible en esta tabla",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "search": "Buscar:",
            }
        })



    </script>
@endsection
