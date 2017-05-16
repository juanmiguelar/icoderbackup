@extends(Auth::user()->tipo)

@section('header')
    <div class="page-header">
        <h3>Ver Deporte</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('deportes.index') }}"><i class="glyphicon glyphicon-backward"></i> Regresar</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('deportes.edit', $deporte->id_deporte) }}">
                    <i class="glyphicon glyphicon-edit"></i> Editar
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="four wide column">
              <h4><i class="deporte icon"></i>Nombre</h4>
            </div>
            <div class="twelve wide column">
              <h4>{{ $deporte->nombre }}</h4>
            </div>
            <div class="four wide column">
              <h4><i class="deporte icon"></i>Numero máximo atletas</h4>
            </div>
            <div class="twelve wide column">
              <h4>{{ $deporte->numero_maximo_atletas }}</h4>
            </div>
            <div class="four wide column">
              <h4><i class="deporte icon"></i>Tipo</h4>
            </div>
            <div class="twelve wide column">
              <h4>{{ $deporte->tipo }}</h4>
            </div>
        </div>
    </div>
@endsection
