@extends(Auth::user()->tipo)

@section('header')
    <div class="page-header clearfix">
        <h3>
            <i class="glyphicon glyphicon-align-justify"></i> Ramas
            <a class="btn btn-success pull-right" href="{{ route('ramas.create') }}"><i class="glyphicon glyphicon-plus"></i> Crear</a>
        </h3>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($ramas->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Deporte</th>
                            <th>Categoría</th>
                            <th>Rama</th>
                            <th class="text-right">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($deportes as $deporte)
                        @foreach($categorias as $categoria)
                            @foreach($ramas as $rama)
                                 @if($deporte->id_deporte == $categoria->id_deporte)
                                    @if($categoria->id_categoria == $rama->id_categoria)
                                            <tr>
                                                <td class="text-center">{{$deporte->nombre}}</td>
                                                
                                                <td>{{$categoria->nombre}}</td>
                                                <td><strong>{{$rama->nombre}}</strong></td>
                                                
                                                <td class="text-right">
                                                    
                                                    <a class="btn btn-xs btn-warning" href="{{ route('ramas.edit', $rama->id) }}">
                                                        <i class="glyphicon glyphicon-edit"></i> Editar
                                                    </a>
                
                                                    <form action="{{ route('ramas.destroy', $rama->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="_method" value="DELETE">
                
                                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
                                @endforeach    
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
                {!! $ramas->render() !!}
            @else
                <h3 class="text-center alert alert-info">No hay ramas registrada</h3>
            @endif

        </div>
    </div>

@endsection