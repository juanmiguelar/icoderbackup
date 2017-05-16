@extends(Auth::user()->tipo)

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Persona / Edit #{{$persona->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('personas.update', $persona->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	<label for="cedula_persona-field">Cedula_persona</label>
	<input class="form-control" type="text" name="cedula_persona" id="cedula_persona-field" value="{{ old('cedula_persona', $persona->cedula_persona ) }}" />
</div> <div class="form-group">
	<label for="nombre1-field">Nombre1</label>
	<input class="form-control" type="text" name="nombre1" id="nombre1-field" value="{{ old('nombre1', $persona->nombre1 ) }}" />
</div> <div class="form-group">
	<label for="nombre2-field">Nombre2</label>
	<input class="form-control" type="text" name="nombre2" id="nombre2-field" value="{{ old('nombre2', $persona->nombre2 ) }}" />
</div> <div class="form-group">
	<label for="apellido1-field">Apellido1</label>
	<input class="form-control" type="text" name="apellido1" id="apellido1-field" value="{{ old('apellido1', $persona->apellido1 ) }}" />
</div> <div class="form-group">
	<label for="apellido2-field">Apellido2</label>
	<input class="form-control" type="text" name="apellido2" id="apellido2-field" value="{{ old('apellido2', $persona->apellido2 ) }}" />
</div> <div class="form-group">
	<label for="fecha_nacimiento-field">Fecha_nacimiento</label>
	--fecha_nacimiento--
</div> <div class="form-group">
	<label for="nacionalidad-field">Nacionalidad</label>
	<input class="form-control" type="text" name="nacionalidad" id="nacionalidad-field" value="{{ old('nacionalidad', $persona->nacionalidad ) }}" />
</div> <div class="form-group">
	<label for="telefono-field">Telefono</label>
	<input class="form-control" type="text" name="telefono" id="telefono-field" value="{{ old('telefono', $persona->telefono ) }}" />
</div> <div class="form-group">
	<label for="direccion-field">Direccion</label>
	<input class="form-control" type="text" name="direccion" id="direccion-field" value="{{ old('direccion', $persona->direccion ) }}" />
</div> <div class="form-group">
	<label for="estatura-field">Estatura</label>
	--estatura--
</div> <div class="form-group">
	<label for="peso-field">Peso</label>
	--peso--
</div> <div class="form-group">
	<label for="tipo_sangre-field">Tipo_sangre</label>
	<input class="form-control" type="text" name="tipo_sangre" id="tipo_sangre-field" value="{{ old('tipo_sangre', $persona->tipo_sangre ) }}" />
</div> <div class="form-group">
	<label for="tipo-field">Tipo</label>
	<input class="form-control" type="text" name="tipo" id="tipo-field" value="{{ old('tipo', $persona->tipo ) }}" />
</div> <div class="form-group">
	<label for="email-field">Email</label>
	<input class="form-control" type="text" name="email" id="email-field" value="{{ old('email', $persona->email ) }}" />
</div> <div class="form-group">
	<label for="cedula_frente-field">Cedula_frente</label>
	<input class="form-control" type="text" name="cedula_frente" id="cedula_frente-field" value="{{ old('cedula_frente', $persona->cedula_frente ) }}" />
</div> <div class="form-group">
	<label for="cedula_atras-field">Cedula_atras</label>
	<input class="form-control" type="text" name="cedula_atras" id="cedula_atras-field" value="{{ old('cedula_atras', $persona->cedula_atras ) }}" />
</div> <div class="form-group">
	<label for="boleta_inscripcion-field">Boleta_inscripcion</label>
	<input class="form-control" type="text" name="boleta_inscripcion" id="boleta_inscripcion-field" value="{{ old('boleta_inscripcion', $persona->boleta_inscripcion ) }}" />
</div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('personas.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection