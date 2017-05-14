@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Persona
            <a class="btn btn-success pull-right" href="{{ route('personas.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($personas->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Cedula_persona</th> <th>Nombre1</th> <th>Nombre2</th> <th>Apellido1</th> <th>Apellido2</th> <th>Fecha_nacimiento</th> <th>Nacionalidad</th> <th>Telefono</th> <th>Direccion</th> <th>Estatura</th> <th>Peso</th> <th>Tipo_sangre</th> <th>Tipo</th> <th>Email</th> <th>Cedula_frente</th> <th>Cedula_atras</th> <th>Boleta_inscripcion</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($personas as $persona)
                            <tr>
                                <td class="text-center"><strong>{{$persona->id}}</strong></td>

                                <td>{{$persona->cedula_persona}}</td> <td>{{$persona->nombre1}}</td> <td>{{$persona->nombre2}}</td> <td>{{$persona->apellido1}}</td> <td>{{$persona->apellido2}}</td> <td>{{$persona->fecha_nacimiento}}</td> <td>{{$persona->nacionalidad}}</td> <td>{{$persona->telefono}}</td> <td>{{$persona->direccion}}</td> <td>{{$persona->estatura}}</td> <td>{{$persona->peso}}</td> <td>{{$persona->tipo_sangre}}</td> <td>{{$persona->tipo}}</td> <td>{{$persona->email}}</td> <td>{{$persona->cedula_frente}}</td> <td>{{$persona->cedula_atras}}</td> <td>{{$persona->boleta_inscripcion}}</td>
                                
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('personas.show', $persona->id) }}">
                                        <i class="glyphicon glyphicon-eye-open"></i> View
                                    </a>
                                    
                                    <a class="btn btn-xs btn-warning" href="{{ route('personas.edit', $persona->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('personas.destroy', $persona->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $personas->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection