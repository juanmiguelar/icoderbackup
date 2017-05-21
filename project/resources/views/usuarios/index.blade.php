@extends(Auth::user()->tipo)

@section('header')
    <div class="page-header clearfix">
        <h3>
            <i class="glyphicon glyphicon-align-justify"></i> Usuarios
            <a class="btn btn-success pull-right" href="{{ route('usuarios.create') }}"><i class="glyphicon glyphicon-plus"></i> Crear</a>
        </h3>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Tipo</th> 
                            <th class="text-right">Opciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td class="text-center"><strong>{{$usuario->id}}</strong></td>

                                <td>{{$usuario->name}}</td> <td>{{$usuario->email}}</td> <td>{{$usuario->tipo}}</td>
                                
                                <td class="text-right">
                                    
                                    <a class="btn btn-xs btn-warning" href="{{URL::to('/') }}/editar_privilegio/{$usuario->id}">
                                        <i class="glyphicon glyphicon-edit"></i> Editar Privilegio
                                    </a>
                                    
                                    <a class="btn btn-xs btn-warning" href="{{ route('usuarios.edit', $usuario->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Editar
                                    </a>

                                    <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $usuarios->render() !!}
            @else
                <h3 class="text-center alert alert-info">No hay usuarios registrados</h3>
            @endif

        </div>
    </div>

@endsection