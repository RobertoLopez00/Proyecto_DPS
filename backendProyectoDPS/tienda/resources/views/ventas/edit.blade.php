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
                                {{ __('Actualizar estado') }}
                            </span>

                            <div class="float-right">
                                <a class="btn btn-primary" href="{{ route('ventas.index') }}"> {{ __('Regresar') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('ventas.update', $venta->id) }}" role="form"
                            enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf
                            <div class="mb-3">

                                <label for="estado">Estado</label>
                                <select name="estado" class="form-select" id="estado"
                                    aria-label="Default select example">

                                    @foreach ($estados as $estado)
                                    @if ($estado->id == $venta->estado->id)
                                    <option value="{{$estado->id}}" selected>{{$estado->estado}}</option>
                                        
                                    @else
                                    <option value="{{$estado->id}}">{{$estado->estado}}</option>
                                    @endif
                                        
                                    @endforeach


                                  

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
