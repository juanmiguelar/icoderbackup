@extends(Auth::user()->tipo)

@section('header')
    <div class="page-header clearfix">
        <h3>
            <i class="glyphicon glyphicon-align-justify"></i> Deportes
            <a class="btn btn-success pull-right" href="{{ route('deportes.create') }}"><i class="glyphicon glyphicon-plus"></i> Crear</a>
        </h3>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($deportes->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th class="text-right">Opciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($deportes as $deporte)
                            <tr>
                                <td class="text-center"><strong>{{$deporte->id_deporte}}</strong></td>
                                <td>{{$deporte->nombre}}</td>
                                <td>{{$deporte->tipo}}</td>
                                
                                <td class="text-right">
                                    
                                    <a class="btn btn-xs btn-warning" href="{{ route('deportes.edit', $deporte->id_deporte) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Editar
                                    </a>

                                    <form action="{{ route('deportes.destroy', $deporte->id_deporte) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Seguro eliminar?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $deportes->render() !!}
            @else
                <h3 class="text-center alert alert-info">No hay deportes registrados</h3>
            @endif

        </div>
    </div>

@endsection