@extends(Auth::user()->tipo)

@section('header')
    <div class="page-header">
        <h1>Edicion {{$edicion->anno}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('edicions.index') }}"><i class="glyphicon glyphicon-backward"></i> Regresar</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('edicions.edit', $edicion->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Editar
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Lugar</th>
                            <th>Fecha Inicio</th> 
                            <th>Fecha Fin</th> 
                            <th>Fecha Inscripción</th> 
                            <th>Fecha Fin Inscripción</th>
                        </tr>
                    </thead>

                    <tbody>
                       
                            <tr>
                                <td class="text-center"><strong>{{$edicion->id}}</strong></td>
                                <td>{{$edicion->lugar}}</td>
                                <td>{{$edicion->fecha_inicio}}</td> 
                                <td>{{$edicion->fecha_fin}}</td> 
                                <td>{{$edicion->fecha_inscripcion}}</td> 
                                <td>{{$edicion->fecha_fin_inscripcion}}</td>  
                            </tr>
                    </tbody>
                </table>

        </div>

    </div>
@endsection
