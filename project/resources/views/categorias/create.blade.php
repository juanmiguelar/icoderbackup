@extends(Auth::user()->tipo)

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Categorium / Create </h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('categorias.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                	<label for="nombre-field">Nombre</label>
                	<input class="form-control" type="text" name="nombre" id="nombre-field" value="" />
                </div>
                <div class="form-group">
                	    <label for="numero_maximo_atletas-field">Número máximo de atletas</label>
                	    <div class="row">
                	        <div class="col-md-1">
                                <div class="numero_maximo_atletas">
                                    <select   class="selectpicker form-control" id="numero_maximo_atletas-field" name="numero" required>
                                        @for ($i = 1; $i < 51; $i++)
                                            <option value="{{ $i }}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a class="btn btn-link pull-right" href="{{ route('categorias.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection