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
                                {{ __('Actualizar categoría') }}
                            </span>

                            <div class="float-right">
                                <a class="btn btn-primary" href="{{ route('categorias.index') }}"> {{ __('Regresar') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('categorias.update', $categoria->id) }}" role="form"
                            enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf
                            <div class="mb-3">

                                <div class="mb-3">

                                    <label for="categoria">Categoría</label>
                                    <input value='{{ $categoria->categoria }}' type="text" name="categoria"
                                        class="form-control" placeholder="Categoría" required>

                                    {!! $errors->first('categoria', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3">
                                    <label for="imagen">Foto: </label>
                                    <input name="imagen" accept="image/*" type="file">
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
