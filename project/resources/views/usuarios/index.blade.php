@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Usuario
            <a class="btn btn-success pull-right" href="{{ route('usuarios.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($usuarios->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Cedula_usuario</th> <th>Nombre1</th> <th>Nombre2</th> <th>Apellido1</th> <th>Apellido2</th> <th>Tipo</th> <th>Email</th> <th>Contrasenna</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td class="text-center"><strong>{{$usuario->id}}</strong></td>

                                <td>{{$usuario->cedula_usuario}}</td> <td>{{$usuario->nombre1}}</td> <td>{{$usuario->nombre2}}</td> <td>{{$usuario->apellido1}}</td> <td>{{$usuario->apellido2}}</td> <td>{{$usuario->tipo}}</td> <td>{{$usuario->email}}</td> <td>{{$usuario->contrasenna}}</td>
                                
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('usuarios.show', $usuario->id) }}">
                                        <i class="glyphicon glyphicon-eye-open"></i> View
                                    </a>
                                    
                                    <a class="btn btn-xs btn-warning" href="{{ route('usuarios.edit', $usuario->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $usuarios->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection