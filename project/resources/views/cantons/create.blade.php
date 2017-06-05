@extends(Auth::user()->tipo)

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Crear cantón</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('cantons.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                	<label for="nombre-field">Nombre</label>
                	<input class="form-control" type="text" name="nombre" id="nombre-field" required/>
                </div>
                 <div class="form-group">
            	<label for="provincia-field">Provincia</label>
                	<div class="row">
                	        <div class="col-xs-6 col-sm-3">
                                <div class="provincia">
                                    <select class="selectpicker form-control" id="provincia" name="provincia" required>
                                            @foreach($provincias as $provincia)
                                                <option value="{{$provincia->id_provincia}}">{{$provincia->nombre}}</option>
                                            @endforeach
                                    </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a class="btn btn-link pull-right" href="{{ route('cantons.index') }}"><i class="glyphicon glyphicon-backward"></i> Atrás</a>
                </div>
            </form>

        </div>
    </div>
@endsection