@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Prueba / Show #{{$prueba->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('pruebas.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('pruebas.edit', $prueba->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="four wide column">
  <h4><i class="prueba icon"></i>Id_prueba</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $prueba->id_prueba }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="prueba icon"></i>Nombre</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $prueba->nombre }}</h4>
</div>


        </div>

    </div>
@endsection
