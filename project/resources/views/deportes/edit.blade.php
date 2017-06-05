@extends(Auth::user()->tipo)

@section('header')
    <div class="page-header">
        <h3><i class="glyphicon glyphicon-edit"></i> Editar Deporte: {{$deporte->nombre}}</h3>
        
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('deportes.update', $deporte->id_deporte) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
	                <label for="nombre-field">Nombre</label>
                	<input class="form-control" type="text" name="nombre" id="nombre-field" value="{{ old('nombre', $deporte->nombre ) }}"  required/>
                </div> 
                <div class="form-group">
                	<label for="tipo-field">Tipo</label>
                	 <div class="row">
                	        <div class="col-xs-6 col-sm-3">
                                <div class="tipo">
                                    <select   class="selectpicker form-control" id="tipo-field" name="tipo" required>
                                            <option value="Individual" {{ $deporte->tipo == "Individual" ? 'selected' : '' }}>Individual</option>
                                            <option value="Grupal" {{ $deporte->tipo == "Grupal" ? 'selected' : '' }}>Grupal</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a class="btn btn-link pull-right" href="{{ route('deportes.index') }}"><i class="glyphicon glyphicon-backward"></i> Atrás</a>
                </div>
            </form>
        </div>
    </div>
@endsection