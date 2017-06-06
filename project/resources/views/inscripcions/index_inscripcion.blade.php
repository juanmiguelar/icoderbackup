@extends(Auth::user()->tipo)

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> {{ $deporteSeleccionado }}
        </h1>
    </div>
@endsection

@section('content')

    <div class="row">
        <form action="" class="form-inline">
            <div class="dropdown form-group">
              <button class="btn btn-default dropdown-toggle form-control" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Deportes
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                @foreach($deportes as $deporte)
                    <li><a href="{{URL::to('/') }}/index_inscripcion/{{$deporte->id_deporte}}">{{$deporte->nombre}}</a></li>
                @endforeach
              </ul>
            </div>
            
            <div class="dropdown form-group">
              <button class="btn btn-default dropdown-toggle form-control" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Filtro
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                <li><a href="#" class="active">Todos</a></li>
              </ul>
            </div>
            
            <div class="btn-group pull-right" role="group" aria-label="...">
              <a type="button" class="btn btn-default" href="{{ url('inscripcion_individual') }}">Inscripción Individual</a>
              <a type="button" class="btn btn-default">Inscripción Grupal</a>
              <a type="button" class="btn btn-default">Reporte</a>
            </div>
        </form>
        
    </div>

    <div class="row">
        <div class="col-md-12">
            @if($deportistas->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Pase_cantonal</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($deportistas as $deportistum)
                            <tr>
                                <td class="text-center"><strong>{{$deportistum->id}}</strong></td>

                                <td>{{$deportistum->pase_cantonal}}</td>
                                
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('deportistas.show', $deportistum->id) }}">
                                        <i class="glyphicon glyphicon-eye-open"></i> View
                                    </a>
                                    
                                    <a class="btn btn-xs btn-warning" href="{{ route('deportistas.edit', $deportistum->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('deportistas.destroy', $deportistum->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $deportistas->render() !!}
            @else
                <h3 class="text-center alert alert-info">No hay inscritos!</h3>
            @endif

        </div>
    </div>

@endsection