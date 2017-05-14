@extends('layout_tabs')

    @section('documentos')
        <div class="row">
            <div class="col-md-12">
                <h3>Adjuntar Documentos</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <form >
                    <div class="form-group">    
                        <label for="pasaporte_field">Fotografía Pasaporte</label>
                        <input type="text" class="form-control" id="pasaporte_field" placeholder="">
                    </div>
                    <div class="form-group">    
                        <label for="cedula_arriba_field">Fotografía cédula arriba</label>
                        <input type="text" class="form-control" id="cedula_arriba_field" placeholder="">
                    </div>
                    <div class="form-group">    
                        <label for="cedula_abajo_field">Fotografía cédula abajo</label>
                        <input type="text" class="form-control" id="cedula_abajo_fiel" placeholder="">
                    </div>
                    <div class="form-group">    
                        <label for="boleta_field">Boleta Inscripción</label>
                        <input type="text" class="form-control" id="boleta_field" placeholder="">
                    </div>
                    <div class="form-group">    
                        <label for="pase_cantonal_field">Pase Cantonal</label>
                        <input type="text" class="form-control" id="pase_cantonal_field" placeholder="">
                    </div>
                    
                    <div class="col-md-4">
                        <input class="btn btn-default" type="submit" value="Guardar">
                    </div>
                    
                    <div class="col-md-4">
                        <input class="btn btn-default" type="submit" value="Finalizar">
                    </div>
                    
                    <div class="col-md-4">
                        <input class="btn btn-default" type="submit" value="Cancelar">
                    </div>
                </form>
            </div>
        </div>
 @endsection