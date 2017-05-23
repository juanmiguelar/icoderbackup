@extends(Auth::user()->tipo)

@section('header')
    <div class="page-header">
        <h3><i class="glyphicon glyphicon-edit"></i> Editar usuario {{$usuario->name}}</h3>
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
                	<label for="nombre-field">Nombre</label>
                	<input class="form-control" type="text" name="nombre" id="nombre-field" value="{{ old('nombre', $usuario->name ) }}" required />
                </div> 
                <div class="form-group">
                	<label for="email-field">Correo</label>
                	<input class="form-control" type="text" name="email" id="email-field" value="{{ old('email', $usuario->email ) }}" required />
                </div> 
                <div class="form-group">
                	<label for="tipo-field">Tipo</label>
                	<select id="tipo-field" name="tipos" class="form-control" required>
                      <option value="estandar" {{ $usuario->tipo == "estandar" ? 'selected' : '' }}>Estándar</option>
                      <option value="admin" {{ $usuario->tipo == "admin" ? 'selected' : '' }}>Administrador</option>
                    </select>
                </div> 
                <div class="form-group">
                	<label for="canton-field">Cantón</label>
                	<select id="canton-field" name="cantones" class="form-control" required >
                	    @foreach($cantones as $canton)
                	        <option value="{{ $canton->id_canton }}" {{ $usuario->id_canton ==  $canton->id_canton  ? 'selected' : '' }}>{{ $canton->nombre }}</option>
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