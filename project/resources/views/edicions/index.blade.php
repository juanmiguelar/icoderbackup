@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Edicion
            <a class="btn btn-success pull-right" href="{{ route('edicions.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($edicions->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Lugar</th> <th>Fecha_inicio</th> <th>Fecha_fin</th> <th>Fecha_inscripcion</th> <th>Fecha_fin_inscripcion</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($edicions as $edicion)
                            <tr>
                                <td class="text-center"><strong>{{$edicion->id}}</strong></td>

                                <td>{{$edicion->lugar}}</td> <td>{{$edicion->fecha_inicio}}</td> <td>{{$edicion->fecha_fin}}</td> <td>{{$edicion->fecha_inscripcion}}</td> <td>{{$edicion->fecha_fin_inscripcion}}</td>
                                
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('edicions.show', $edicion->id) }}">
                                        <i class="glyphicon glyphicon-eye-open"></i> View
                                    </a>
                                    
                                    <a class="btn btn-xs btn-warning" href="{{ route('edicions.edit', $edicion->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('edicions.destroy', $edicion->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $edicions->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection