@extends(Auth::user()->tipo)

@section('header')
    <div class="page-header">
        <h3><i class="glyphicon glyphicon-plus"></i>Nueva Edición</h3>
    </div>
@endsection

@section('content')
    @include('error')

        <div class="row">
            <div class="col-md-12">
                 <form action="{{ route('edicions.store') }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="form-group col-xs-4">
                    	    <label for="lugar-field">Lugar</label>
                    	    <input class=" form-control" type="text" name="lugar" id="lugar-field" value="" placeholder="Digite el lugar de la edición" required/>
                        </div> 
                    </div>
                <div class="row">
                    <div class="form-group col-md-1">
                	    <label for="anno-field">Año</label>
                            <select  class="selectpicker form-control" id="anno-field" name="anno" required>
                                @for ($i = $anno-10 ; $i < $anno+10 ; $i++)
                                    <option value= "{{ $i }}" {{ $anno == $i ? 'selected' : '' }}>{{$i}}</option>
                                @endfor
                           </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-2">
                    	<label for="fecha_inicio-field">Fecha inicial de edición</label>
                    	    <div class="input-group date" data-provide="datepicker">
                                <input type="text" class="form-control" id="fecha_inicio-field" name="fecha_inicio" data-date-format="YYYY-MM-DD" required>
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
                                <input type="text" class="form-control" id="fecha_fin-field" name="fecha_fin" data-date-format="YYYY-MM-DD" required>
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
                            <input type="text" class="form-control" id="fecha_inscripcion-field" name="fecha_inscripcion" data-date-format="YYYY-MM-DD" required>
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
                            <input type="text" class="form-control" id="fecha_fin_inscripcion-field" name="fecha_fin_inscripcion" data-date-format="YYYY-MM-DD" required>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="well well-sm">
                <button type="submit" class="btn btn-primary">Guardar</button>
                 <a class="btn btn-link pull-right" href="{{ route('edicions.index') }}"><i class="glyphicon glyphicon-backward"></i>Volver</a>
            </div>
        </form>
    </div>
</div>
@endsection