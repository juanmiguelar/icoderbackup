@extends(Auth::user()->tipo)

@section('header')
    <div class="page-header">
        <h1>Provincium / Show #{{$provincium->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('provincias.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('provincias.edit', $provincium->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="four wide column">
  <h4><i class="provincium icon"></i>Nombre</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $provincium->nombre }}</h4>
</div>


        </div>

    </div>
@endsection
