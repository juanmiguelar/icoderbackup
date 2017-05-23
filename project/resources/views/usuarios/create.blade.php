@extends(Auth::user()->tipo)

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Crear usuarios</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('usuarios.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group @if($errors->has('nombre')) has-error @endif">
                	<label for="nombre-field">Nombre</label>
                	<input class="form-control" type="text" name="nombre" id="nombre-field" value="{{ old("nombre") }}" />
                	@if($errors->has("nombre"))
                	    <span class="help-block">{{ $errors->first("nombre") }}</span>
                	@endif
                </div> <div class="form-group">
                	<label for="email-field">Correo</label>
                	<input class="form-control" type="text" name="email" id="email-field" value="{{ old("email") }}" />
                </div> <div class="form-group">
                	<label for="contrasena-field">Contraseña</label>
                	<input class="form-control" type="text" name="contrasena" id="email-field" value="{{ old("contrasena") }}" />
                </div> <div class="form-group">
                	<label for="tipo-field">Tipo</label>
                	<select id="tipo-field" name="tipos" class="form-control">
                      <option value="estandar">Estándar</option>
                      <option value="admin">Administrador</option>
                    </select>
                </div> 
                <div class="form-group">
                	<label for="canton-field">Cantón</label>
                	<select id="canton-field" name="cantones" class="form-control">
                	    
                	    @foreach($cantones as $canton)
                	        <option value="{{ $canton->id_canton }}">{{ $canton->nombre }}</option>
                        @endforeach

                    </select>
                </div> 
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a class="btn btn-link pull-right" href="{{ route('usuarios.index') }}"><i class="glyphicon glyphicon-backward"></i> Atrás</a>
                </div>
            </form>

        </div>
    </div>
@endsection