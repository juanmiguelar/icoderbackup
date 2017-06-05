@extends(Auth::user()->tipo)

@section('header')
    <div class="page-header">
        <h3><i class="glyphicon glyphicon-edit"></i> Editar {{$edicion->lugar}} {{$edicion->anno}}</h3>
    </div>
@endsection

@section('content')
    @include('error')
<div class="row">
            <div class="col-md-12">
                 <form action="{{ route('edicions.update', $edicion->anno) }}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="form-group col-xs-4">
                    	    <label for="lugar-field">Lugar</label>
                    	    <input class=" form-control" type="text" name="lugar" id="lugar-field" value="{{ old('lugar', $edicion->lugar ) }}" placeholder="Digite el lugar de la edición" required/>
                        </div> 
                    </div>
                <div class="row">
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-2">
                    	<label for="fecha_inicio-field">Fecha inicial de edición</label>
                    	    <div class="input-group date" data-provide="datepicker">
                                <input type="text" class="form-control" id="fecha_inicio-field" name="fecha_inicio"  value= "{{$edicion->fecha_inicio}}" required>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="row">
                    <div class="form-group col-xs-2">
                	    <label for="fecha_fin-field">Fecha final de edición</label>
                    	    <div class="input-group date" data-provide="datepicker">
                                <input type="text" class="form-control" id="fecha_fin-field" name="fecha_fin" value= "{{$edicion->fecha_fin}}" required>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="row">
                    <div class="form-group col-xs-2">
                    	<label for="fecha_inscripcion-field">Fecha inicial de inscripción</label>
                    	<div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" id="fecha_inscripcion-field" name="fecha_inscripcion" value= "{{$edicion->fecha_inscripcion}}" required>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="form-group col-xs-2">
                    	<label for="fecha_fin_inscripcion-field">Fecha final de inscripción</label>
                    	<div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" id="fecha_fin_inscripcion-field" name="fecha_fin_inscripcion" value= "{{$edicion->fecha_fin_inscripcion}}" required>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="well well-sm">
                <button type="submit" class="btn btn-primary">Guardar</button>
                 <a class="btn btn-link pull-right" href="{{ route('edicions.index') }}"><i class="glyphicon glyphicon-backward"></i> Atrás</a>
            </div>
        </form>
    </div>
</div>
@endsection