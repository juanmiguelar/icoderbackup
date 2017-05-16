@extends(Auth::user()->tipo)

@section('header')
    <div class="page-header">
        <h3>{{$persona->nombre1}} {{$persona->apellido1}} {{$persona->apellido2}}
          <a class="btn btn-sm btn-warning pull-right" href="{{ route('personas.edit', $persona->cedula_persona) }}">
             <i class="glyphicon glyphicon-edit"></i> Editar
          </a>
        </h3>
    </div>
@endsection

@section('content')
    
    <div class="row">
        <div class="col-md-12">
          <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Cédula </th>
                            <th>Fecha Nacimiento</th> 
                            <th>Nacionalidad</th> 
                            <th>Teléfono</th> 
                            <th>Dirección</th> 
                            <th>Estatura</th> 
                            <th>Peso</th> 
                            <th>Tipo Sangre</th> 
                            <th>Tipo</th> 
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td class="text-center"><strong>{{$persona->cedula_persona}}</strong></td>
                                <td>{{$persona->fecha_nacimiento}}</td>
                                <td>{{$persona->nacionalidad}}</td> 
                                <td>{{$persona->telefono}}</td> 
                                <td>{{$persona->direccion}}</td> 
                                <td>{{$persona->estatura}}</td>
                                <td>{{$persona->peso}}</td> 
                                <td>{{$persona->tipo_sangre}}</td> 
                                <td>{{$persona->tipo}}</td> 
                                <td>{{$persona->email}}</td> 
                            </tr>
                    </tbody>
                </table>
        </div>
    </div>
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('personas.index') }}"><i class="glyphicon glyphicon-backward"></i> Regresar</a>
            </div>
        </div>
    </div>
@endsection
