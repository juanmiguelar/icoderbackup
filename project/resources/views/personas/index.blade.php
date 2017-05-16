@extends(Auth::user()->tipo)

@section('header')
    <div class="page-header clearfix">
        <h3>
            <i class="glyphicon glyphicon-align-justify"></i> Persona
            <a class="btn btn-success pull-right" href="{{ route('personas.create') }}"><i class="glyphicon glyphicon-plus"></i> Crear</a>
        </h3>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($personas->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                           
                            <th class="text-center">Cédula Persona</th>
                            <th>Nombre</th> 
                            <th>Apellidos</th> 
                            <th class="text-right">Opciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($personas as $persona)
                            <tr>
                                <td class="text-center"><strong>{{$persona->cedula_persona}}</strong></td>

                                 
                                <td>{{$persona->nombre1}} {{$persona->nombre2}}</td>
                                <td>{{$persona->apellido1}} {{$persona->apellido2}}</td> 
                                
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('personas.show', $persona->cedula_persona) }}">
                                        <i class="glyphicon glyphicon-eye-open"></i> Ver
                                    </a>
                                    
                                    <a class="btn btn-xs btn-warning" href="{{ route('personas.edit', $persona->cedula_persona) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Editar
                                    </a>

                                    <form action="{{ route('personas.destroy', $persona->cedula_persona) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $personas->render() !!}
            @else
                <h3 class="text-center alert alert-info">No hay personas registradas</h3>
            @endif

        </div>
    </div>

@endsection