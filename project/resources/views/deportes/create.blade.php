@extends(Auth::user()->tipo)

@section('header')
    <div class="page-header">
        <h3><i class="glyphicon glyphicon-plus"></i> Ingresar Deporte</h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

        <form action="{{ route('deportes.store') }}" method="POST">
     <input type="hidden" name="_token" value="{{ csrf_token() }}">

     <div class="form-group">
	<label for="nombre-field">Nombre</label>
	<input class="form-control" type="text" name="nombre" id="nombre-field" value="" placeholder="Ingrese aquí el nombre del deporte"  required/>
    </div> 
    <div class="form-group">
	<label for="tipo-field">Tipo</label>
	 <div class="row">
	        <div class="col-xs-6 col-sm-3">
                <div class="tipo">
                    <select   class="selectpicker form-control" id="tipo-field" name="tipo" required>
                            <option value="Individual">Individual</option>
                            <option value="Grupal">Grupal</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
     <div class="form-group">
	    <label for="numero_maximo_atletas-field">Número máximo de atletas</label>
	    <div class="row">
	        <div class="col-md-1">
                <div class="numero_maximo_atletas">
                    <select   class="selectpicker form-control" id="numero_maximo_atletas-field" name="numero" required>
                        @for ($i = 1; $i < 51; $i++)
                            <option value="{{ $i }}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a class="btn btn-link pull-right" href="{{ route('deportes.index') }}"><i class="glyphicon glyphicon-backward"></i>Volver</a>
                </div>
            </form>

        </div>
    </div>
@endsection