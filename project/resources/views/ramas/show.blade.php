@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Rama / Show #{{$rama->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('ramas.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('ramas.edit', $rama->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="four wide column">
  <h4><i class="rama icon"></i>Id_rama</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $rama->id_rama }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="rama icon"></i>Nombre</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $rama->nombre }}</h4>
</div>


        </div>

    </div>
@endsection
