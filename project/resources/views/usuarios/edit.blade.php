@extends(Auth::user()->tipo)

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Usuario / Edit #{{$usuario->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                	<label for="cedula_usuario-field">Cedula_usuario</label>
                	<input class="form-control" type="text" name="cedula_usuario" id="cedula_usuario-field" value="{{ old('cedula_usuario', $usuario->cedula_usuario ) }}" />
                </div> <div class="form-group">
                	<label for="nombre1-field">Nombre1</label>
                	<input class="form-control" type="text" name="nombre1" id="nombre1-field" value="{{ old('nombre1', $usuario->nombre1 ) }}" />
                </div> <div class="form-group">
                	<label for="nombre2-field">Nombre2</label>
                	<input class="form-control" type="text" name="nombre2" id="nombre2-field" value="{{ old('nombre2', $usuario->nombre2 ) }}" />
                </div> <div class="form-group">
                	<label for="apellido1-field">Apellido1</label>
                	<input class="form-control" type="text" name="apellido1" id="apellido1-field" value="{{ old('apellido1', $usuario->apellido1 ) }}" />
                </div> <div class="form-group">
                	<label for="apellido2-field">Apellido2</label>
                	<input class="form-control" type="text" name="apellido2" id="apellido2-field" value="{{ old('apellido2', $usuario->apellido2 ) }}" />
                </div> <div class="form-group">
                	<label for="tipo-field">Tipo</label>
                	<input class="form-control" type="text" name="tipo" id="tipo-field" value="{{ old('tipo', $usuario->tipo ) }}" />
                </div> <div class="form-group">
                	<label for="email-field">Email</label>
                	<input class="form-control" type="text" name="email" id="email-field" value="{{ old('email', $usuario->email ) }}" />
                </div> <div class="form-group">
                	<label for="contrasenna-field">Contrasenna</label>
                	<input class="form-control" type="text" name="contrasenna" id="contrasenna-field" value="{{ old('contrasenna', $usuario->contrasenna ) }}" />
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('usuarios.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection