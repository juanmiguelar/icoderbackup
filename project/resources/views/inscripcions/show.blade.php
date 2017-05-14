@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Inscripcion / Show #{{$inscripcion->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('inscripcions.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('inscripcions.edit', $inscripcion->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="four wide column">
  <h4><i class="inscripcion icon"></i>Id_inscripcion</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $inscripcion->id_inscripcion }}</h4>
</div>


        </div>

    </div>
@endsection
