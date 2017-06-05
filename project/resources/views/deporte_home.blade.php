
@extends(Auth::user()->tipo)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Seleccione el deporte</div>

                <div class="panel-body">
                    
                   <div class="dropdown">
                      <button class="btn btn-default dropdown-toggle form-control" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Deporte
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        @foreach($deportes as $deporte)
                            <li><a href="{{URL::to('/') }}/index_inscripcion/{{$deporte->id_deporte}}">{{$deporte->nombre}}</a></li>
                        @endforeach
                      </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
