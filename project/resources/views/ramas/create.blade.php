@extends(Auth::user()->tipo)

@section('header')
    <div class="page-header">
        <h3><i class="glyphicon glyphicon-plus"></i> Crear rama</h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('ramas.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                	<label for="nombre-field">Nombre</label>
                	<input class="form-control" type="text" name="nombre" id="nombre-field" value="" />
                </div>
                 <div class="form-group">
            	<label for="categoria-field">Categoría</label>
                	<div class="row">
                	        <div class="col-xs-6 col-sm-3">
                                <div class="categoria">
                                    <select class="selectpicker form-control" id="categoria" name="categoria" required>
                                            @foreach($categorias as $categoria)
                                                <option value="{{$categoria->id_categoria}}">{{$categoria->deporNombre}}-{{$categoria->nombre}}</option>
                                            @endforeach
                                    </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a class="btn btn-link pull-right" href="{{ route('ramas.index') }}"><i class="glyphicon glyphicon-backward"></i>  Atrás</a>
                </div>
            </form>

        </div>
    </div>
@endsection