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
                                {{ __('Usuarios') }}
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


                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Dui</th>
                                        <th>Dirección</th>
                                        <th>Teléfono</th>
                                        <th>Correo</th>
                                        <th>Rol</th>
                                        <th>Usuario</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody id="TablaIndex">
                                    @foreach ($usuarios as $usuario)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td>{{ $usuario->nombres }}</td>
                                            <td>{{ $usuario->apellidos }}</td>
                                            <td>{{ $usuario->dui }}</td>
                                            <td>{{ $usuario->direccion }}</td>
                                            <td>{{ $usuario->telefono }}</td>
                                            <td>{{ $usuario->email }}</td>
                                            <td>{{ $usuario->rol->rol }}</td>
                                            <td>{{ $usuario->usuario }}</td>
                                            <td>{{ $usuario->estado }}</td>

                                            <td>
                                                <form action="{{ route('usuarios.destroy', $usuario->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('usuarios.show', $usuario->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('usuarios.edit', $usuario->id) }}"><i
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
    <form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar Usuario</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @includeif('partials.errors')

                        @csrf

                        <div class="mb-3">

                            <label for="nombres">Nombres</label>
                            <input type="text" name="nombres" class="form-control" placeholder="Nombres" required>

                            {!! $errors->first('nombres', '<div class="invalid-feedback">:message</div>') !!}

                        </div>

                        <div class="mb-3">

                            <label for="apellidos">Apellidos</label>
                            <input type="text" name="apellidos" class="form-control" placeholder="Apellidos" required>

                            {!! $errors->first('apellidos', '<div class="invalid-feedback">:message</div>') !!}

                        </div>

                        <div class="mb-3" <label for="dui">Dui *</label>
                            <input id="dui" type="text" maxlength="10" name="dui" class="form-control" placeholder="Dui" required>

                            {!! $errors->first('dui', '<div class="invalid-feedback">:message</div>') !!}

                        </div>

                        

                        <div class="mb-3">

                            <label for="direccion">direccion</label>
                            <input type="text" name="direccion" class="form-control" placeholder="Dirección" >
                            
                            {!! $errors->first('direccion', '<div class="invalid-feedback">:message</div>') !!}

                        </div>






                        <div class="mb-3">

                            <label for="id_rol">Rol</label>
                            <select name="id_rol" class="form-select" id="id_rol" aria-label="Default select example"
                                required>
                                <option selected="true" disabled="disabled">Seleccione un rol</option>
                                @foreach ($roles as $rol)
                                    <option value="{{ $rol->id }}">{{ $rol->rol }}</option>
                                @endforeach
                            </select>

                            {!! $errors->first('id_rol', '<div class="invalid-feedback">:message</div>') !!}

                        </div>


                        <div class="mb-3">

                            <label for="telefono">Telefono</label>
                            <input type="number" name="telefono" class="form-control" placeholder="Telefono" required>

                            {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}

                        </div>

                        <div class="mb-3">

                            <label for="usuario">Usuario</label>
                            <input type="text" name="usuario" class="form-control" placeholder="Usuario" required>

                            {!! $errors->first('usuario', '<div class="invalid-feedback">:message</div>') !!}

                        </div>

                        <div class="mb-3">

                            <label for="email">Correo</label>
                            <input type="email" name="email" class="form-control" placeholder="Correo" required>

                            {!! $errors->first('emaill', '<div class="invalid-feedback">:message</div>') !!}

                        </div>

                        <div class="mb-3">

                            <label for="password">Contraseña</label>
                            <input type="text" name="password" class="form-control" placeholder="Contraseña"
                                required>

                            {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}

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

    $('#dui').on('keypress', function(event) {

        const valor = $(this).val(); // Obtiene el valor actual del input
        const largo = valor.length; // Obtiene la longitud del valor
        const teclaPresionada = event.key;
        // Inserta un guion después del octavo carácter si es posible
        if (largo == 8) {
            console.log(valor);

            const nuevoValor = valor.slice(0, 8) + '-' + valor.slice(8)
            $(this).val(nuevoValor);


        }



    });

    $('#nit').on('keypress', function(event) {

        const valor = $(this).val(); // Obtiene el valor actual del input
        const largo = valor.length; // Obtiene la longitud del valor
        const teclaPresionada = event.key;
        // Inserta un guion después del octavo carácter si es posible
        if (largo == 4) {
            console.log(valor);

           
            const nuevoValor = valor.slice(0, 4) + '-' + valor.slice(4) 
            $(this).val(nuevoValor);



        }
        else if (largo == 11) {
            console.log(valor);

           
            const nuevoValor = valor.slice(0, 12) + '-' + valor.slice(12) 
            $(this).val(nuevoValor);



        }
        else if (largo == 15) {
            console.log(valor);

           
            const nuevoValor = valor.slice(0, 16) + '-' + valor.slice(16) 
            $(this).val(nuevoValor);



        }

       



    });
</script>
@endsection
