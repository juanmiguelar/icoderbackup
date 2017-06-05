@extends(Auth::user()->tipo)

@section('header')
    <div class="page-header clearfix">
        <h3>
            <i class="glyphicon glyphicon-align-justify"></i> Cantones
            <a class="btn btn-success pull-right" href="{{ route('cantons.create') }}"><i class="glyphicon glyphicon-plus"></i> Crear</a>
        </h3>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($cantons != null)
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Nombre</th>
                            <th>Provincia</th>
                            <th class="text-right">Opciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($cantons as $canton)
                            @foreach($provincias as $provincia)
                                @if($provincia->id_provincia == $canton->id_provincia)
                                    <tr>
                                        <td class="text-center"><strong>{{$canton->id_canton}}</strong></td>
        
                                        <td>{{$canton->nombre}}</td>
                                        <td>{{$provincia->nombre}}</td>
                                        
                                        <td class="text-right">
                                            <a class="btn btn-xs btn-warning" href="{{ route('cantons.edit', $canton->id_canton) }}">
                                                <i class="glyphicon glyphicon-edit"></i> Editar
                                            </a>
        
                                            <form action="{{ route('cantons.destroy', $canton->id_canton) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Seguro eliminar?');">
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
                {!! $cantons->render() !!}
            @else
                <h3 class="text-center alert alert-info">No hay cantones registrados</h3>
            @endif

        </div>
    </div>

@endsection