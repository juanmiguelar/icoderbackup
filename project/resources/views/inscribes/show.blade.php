@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Inscribe / Show #{{$inscribe->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('inscribes.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('inscribes.edit', $inscribe->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="four wide column">
  <h4><i class="inscribe icon"></i>Anno</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $inscribe->anno }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="inscribe icon"></i>Cedula_persona</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $inscribe->cedula_persona }}</h4>
</div>


        </div>

    </div>
@endsection
