@
@if(Auth::user()->tipo == "superadmin")
    <?php $layout = 'layoutSuperAdmin'; ?>
@elseif (Auth::user()->tipo == "admin")
    <?php $layout = 'layoutAdmin'; ?>
@else
    <?php $layout = 'layoutEstandar'; ?>
@endif

@extends($layout)


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
                            <th>Nombre</th> <th>Numero máximo atletas</th> <th>Tipo</th>
                            <th class="text-right">Opciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($deportes as $deporte)
                            <tr>
                               
                                <td>{{$deporte->nombre}}</td> <td>{{$deporte->numero_maximo_atletas}}</td> <td>{{$deporte->tipo}}</td>
                                
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('deportes.show', $deporte->id_deporte) }}">
                                        <i class="glyphicon glyphicon-eye-open"></i> Ver
                                    </a>
                                    
                                    <a class="btn btn-xs btn-warning" href="{{ route('deportes.edit', $deporte->id_deporte) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Editar
                                    </a>

                                    <form action="{{ route('deportes.destroy', $deporte->id_deporte) }}" method="POST" style="display: inline;" onsubmit="return confirm('Está seguro de elimnar el deporte?');">
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
                <h3 class="text-center alert alert-info">No hay deportes!</h3>
            @endif

        </div>
    </div>

@endsection