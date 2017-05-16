@extends(Auth::user()->tipo)

@section('header')
    <div class="page-header">
        <h3>{{$categoria->nombre}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('categorias.index') }}"><i class="glyphicon glyphicon-backward"></i> Regresar</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('categorias.edit', $categoria) }}">
                    <i class="glyphicon glyphicon-edit"></i> Editar
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Nombre</th>
                            <th>Edades</th>
                            <th>Años</th>
                        </tr>
                    </thead>

                    <tbody>
                       
                            <tr>
                                <td class="text-center"><strong>{{$categoria->id_categoria}}</strong></td>

                                <td>{{$categoria->nombre}}</td>
                                <td>{{$categoria->edad_inicio}}-{{$categoria->edad_final}}</td>
                                <td>{{$categoria->anno_inicio}}-{{$categoria->anno_final}}</td>  
                            </tr>
                    </tbody>
                </table>
        </div>
    </div>
@endsection
