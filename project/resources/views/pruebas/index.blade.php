@extends(Auth::user()->tipo)

@section('header')
    <div class="page-header clearfix">
        <h3>
            <i class="glyphicon glyphicon-align-justify"></i> Prueba
            <a class="btn btn-success pull-right" href="{{ route('pruebas.create') }}"><i class="glyphicon glyphicon-plus"></i> Crear</a>
        </h3>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($pruebas->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Deporte</th>
                            <th>Categoría</th>
                            <th>Prueba</th>
                            <th class="text-right">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pruebas as $prueba)
                            @foreach($categorias as $categoria)
                                @if($categoria->id_categoria == $prueba->id_categoria)
                                            <tr>
                                                <td class="text-center">{{$categoria->deporNombre}}</td>
                                                
                                                <td>{{$categoria->nombre}}</td>
                                                <td>{{$prueba->nombre}}</td>
                                                
                                                <td class="text-right">
                                                    
                                                    <a class="btn btn-xs btn-warning" href="{{ route('pruebas.edit', $prueba->id_prueba) }}">
                                                        <i class="glyphicon glyphicon-edit"></i> Editar
                                                    </a>
                
                                                    <form action="{{ route('pruebas.destroy', $prueba) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Seguro eliminar?');">
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
                {!! $pruebas->render() !!}
            @else
                <h3 class="text-center alert alert-info">No hay pruebas registradas</h3>
            @endif

        </div>
    </div>

@endsection