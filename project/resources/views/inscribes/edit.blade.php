@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Inscribe / Edit #{{$inscribe->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('inscribes.update', $inscribe->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	<label for="anno-field">Anno</label>
	--anno--
</div> <div class="form-group">
	<label for="cedula_persona-field">Cedula_persona</label>
	<input class="form-control" type="text" name="cedula_persona" id="cedula_persona-field" value="{{ old('cedula_persona', $inscribe->cedula_persona ) }}" />
</div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('inscribes.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection