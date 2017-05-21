@extends(Auth::user()->tipo)

@section('header')
    <div class="page-header clearfix">
        <h3>
            <i class="glyphicon glyphicon-align-justify"></i> Categorías
            <a class="btn btn-success pull-right" href="{{ route('categorias.create') }}"><i class="glyphicon glyphicon-plus"></i> Crear</a>
        </h3>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($categorias->count() && $deportes->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Deporte</th>
                            <th>Nombre</th>
                            <th class="text-right">Opciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($categorias as $categoria)
                            @foreach($deportes as $deporte)
                                @if($categoria->id_deporte == $deporte->id_deporte)
                                    <tr>
                                        <td class="text-center"><strong>{{$categoria->id_categoria}}</strong></td>
                                        <td>{{$deporte->nombre}}</td>
                                        <td>{{$categoria->nombre}}</td>
                                        
                                        <td class="text-right">
                                            <a class="btn btn-xs btn-primary" href="{{ route('categorias.show', $categoria->id_categoria) }}">
                                                <i class="glyphicon glyphicon-eye-open"></i> Ver
                                            </a>
                                            
                                            <a class="btn btn-xs btn-warning" href="{{ route('categorias.edit', $categoria->id) }}">
                                                <i class="glyphicon glyphicon-edit"></i> Editar
                                            </a>
        
                                            <form action="{{ route('categorias.destroy', $categoria->id_categoria) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                                {{csrf_field()}}
                                                <input type="hidden" name="_method" value="DELETE">
        
                                                <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach    
                        @endforeach
                    </tbody>
                </table>
                {!! $categorias->render() !!}
            @else
                <h3 class="text-center alert alert-info">No hay categorías registradas</h3>
            @endif

        </div>
    </div>

@endsection