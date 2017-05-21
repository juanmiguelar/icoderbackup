@extends(Auth::user()->tipo)

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Ramas
            <a class="btn btn-success pull-right" href="{{ route('ramas.create') }}"><i class="glyphicon glyphicon-plus"></i> Crear</a>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($ramas->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Id_rama</th> <th>Nombre</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($ramas as $rama)
                            <tr>
                                <td class="text-center"><strong>{{$rama->id}}</strong></td>

                                <td>{{$rama->id_rama}}</td> <td>{{$rama->nombre}}</td>
                                
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('ramas.show', $rama->id) }}">
                                        <i class="glyphicon glyphicon-eye-open"></i> View
                                    </a>
                                    
                                    <a class="btn btn-xs btn-warning" href="{{ route('ramas.edit', $rama->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('ramas.destroy', $rama->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $ramas->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection