@extends(Auth::user()->tipo)

@section('header')
    <div class="page-header clearfix">
        <h3>
            <i class="glyphicon glyphicon-align-justify"></i> Provincias
            <a class="btn btn-success pull-right" href="{{ route('provincias.create') }}"><i class="glyphicon glyphicon-plus"></i> Crear</a>
        </h3>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($provincias->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Nombre</th>
                            <th class="text-right">Opciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($provincias as $provincium)
                            <tr>
                                <td class="text-center"><strong>{{$provincium->id_provincia}}</strong></td>

                                <td>{{$provincium->nombre}}</td>
                                
                                <td class="text-right">
                                    
                                    <a class="btn btn-xs btn-warning" href="{{ route('provincias.edit', $provincium->id_provincia) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Editar
                                    </a>

                                    <form action="{{ route('provincias.destroy', $provincium->id_provincia) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Seguro eliminar?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $provincias->render() !!}
            @else
                <h3 class="text-center alert alert-info">No hay provincias registradas</h3>
            @endif

        </div>
    </div>

@endsection