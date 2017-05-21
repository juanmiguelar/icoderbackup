@extends(Auth::user()->tipo)
@section('header')
    <div class="page-header">
        <h3><i class="glyphicon glyphicon-plus"></i> Editar Privilegios: {{$usuario->name}}</h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

        <form action="{{URL::to('/') }}/store_editar_privilegio/{{$usuario->id}}" method="GET">
     <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="form-group">
	<label for="tipo-field">Tipo</label>
	 <div class="row">
	        <div class="col-xs-6 col-sm-3">
                <div class="tipo">
                    <select class="selectpicker form-control" id="tipo" name="tipo" required>
                            <option value="estandar">Estandar</option>
                            <option value="admin">Administrador</option>
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