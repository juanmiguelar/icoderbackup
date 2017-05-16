@extends(Auth::user()->tipo)

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Edicion / Edit #{{$edicion->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('edicions.update', $edicion->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	<label for="lugar-field">Lugar</label>
	<input class="form-control" type="text" name="lugar" id="lugar-field" value="{{ old('lugar', $edicion->lugar ) }}" />
</div> <div class="form-group">
	<label for="fecha_inicio-field">Fecha_inicio</label>
	--fecha_inicio--
</div> <div class="form-group">
	<label for="fecha_fin-field">Fecha_fin</label>
	--fecha_fin--
</div> <div class="form-group">
	<label for="fecha_inscripcion-field">Fecha_inscripcion</label>
	--fecha_inscripcion--
</div> <div class="form-group">
	<label for="fecha_fin_inscripcion-field">Fecha_fin_inscripcion</label>
	--fecha_fin_inscripcion--
</div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('edicions.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection