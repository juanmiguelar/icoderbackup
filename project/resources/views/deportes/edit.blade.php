@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Deporte / Edit #{{$deporte->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('deportes.update', $deporte->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	<label for="nombre-field">Nombre</label>
	<input class="form-control" type="text" name="nombre" id="nombre-field" value="{{ old('nombre', $deporte->nombre ) }}" />
</div> <div class="form-group">
	<label for="numero_maximo_atletas-field">Numero_maximo_atletas</label>
	--numero_maximo_atletas--
</div> <div class="form-group">
	<label for="tipo-field">Tipo</label>
	<input class="form-control" type="text" name="tipo" id="tipo-field" value="{{ old('tipo', $deporte->tipo ) }}" />
</div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('deportes.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection