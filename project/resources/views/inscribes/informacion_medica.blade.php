@extends('layout_tabs')

    @section('informacion_medica')
        <div class="row">
            <div class="col-md-12">
                <h3>Información Médica</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <form class="form-horizontal">
                    <div class="form-group">    
                        <label for="estatura_field">Estatura</label>
                        <input type="text" class="form-control" id="estatura_field" placeholder="Estatura">
                    </div>
                    <div class="form-group">    
                        <label for="peso_field">Peso</label>
                        <input type="text" class="form-control" id="peso_field" placeholder="Peso">
                    </div>
                    
                    <div class="form-group">    
                         <label for="tipo_sangre_field">Tipo Sangre</label>
                        <input type="text" class="form-control" id="tipo_sangre_field" placeholder="Tipo de Sangre">
                    </div>
                    
                    <div class="col-md-4 col-md-offset-4">
                        <input class="btn btn-default" type="submit" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
 @endsection