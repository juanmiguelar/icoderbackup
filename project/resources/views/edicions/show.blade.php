@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Edicion / Show #{{$edicion->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('edicions.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('edicions.edit', $edicion->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="four wide column">
  <h4><i class="edicion icon"></i>Lugar</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $edicion->lugar }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="edicion icon"></i>Fecha_inicio</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $edicion->fecha_inicio }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="edicion icon"></i>Fecha_fin</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $edicion->fecha_fin }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="edicion icon"></i>Fecha_inscripcion</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $edicion->fecha_inscripcion }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="edicion icon"></i>Fecha_fin_inscripcion</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $edicion->fecha_fin_inscripcion }}</h4>
</div>


        </div>

    </div>
@endsection
