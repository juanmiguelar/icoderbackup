@extends('layout_tabs')
@extends('layouts.app')

    @section('informacion_personal')
        <div class="row">
            <div class="col-md-12">
                <h3>Información Personal</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="dropdownidentificacion">Tipo Identificación</label>
                        
                        <div class="dropdown_identificacion">
                            <select class="form-control" id="dropdown_identificacion">
                                <option>Cédula</option>
                                <option>Pasaporte</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">    
                        <label for="cedula_field">Cédula o Pasaporte</label>
                        <input type="text" class="form-control" id="cedula_field" placeholder="Cédula o Pasaporte" required="required">
                    </div>
                    <div class="form-group">    
                        <label for="nombre_field">Nombre</label>
                        <input type="text" class="form-control" id="nombre_field" placeholder="Nombre" required="required">
                    </div>
                    
                    <div class="form-group">    
                         <label for="apellido1_field">Primer Apellido</label>
                        <input type="text" class="form-control" id="apellido1_field" placeholder="Primer Apellido " required="required">
                    </div>
                    <div class="form-group">   
                        <label for="apellido2_field">Segundo Apellido</label>
                        <input type="text" class="form-control" id="apellido2_field" placeholder="Segundo Apellido" required="required">
                    </div>  
                     <div class="form-group">   
                        <label for="fecha_nacimiento_field">Fecha Nacimiento</label>
                        <input type="date" class="form-control" id="fecha_nacimiento_field" required="required">
                    </div>  
                      
                    <div class="col-md-4 col-md-offset-4">
                        <input class="btn btn-default" type="submit" value="Siguiente">
                    </div>
                </form>
            </div>
        </div>
 @endsection
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
                        <input type="text" class="form-control" id="estatura_field" placeholder="Estatura" required="required">
                    </div>
                    <div class="form-group">    
                        <label for="peso_field">Peso</label>
                        <input type="text" class="form-control" id="peso_field" placeholder="Peso" required="required">
                    </div>
                    
                    <div class="form-group">    
                         <label for="tipo_sangre_field">Tipo Sangre</label>
                        <input type="text" class="form-control" id="tipo_sangre_field" placeholder="Tipo de Sangre" required="required">
                    </div>
                    
                    <div class="col-md-4 col-md-offset-4">
                        <input class="btn btn-default" type="submit" value="Siguiente">
                    </div>
                </form>
            </div>
        </div>
 @endsection
 
   @section('datos_de_contacto')
        <div class="row">
            <div class="col-md-12">
                <h3>Datos de Contacto</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label" for="email_field">Email</label>
                        <input type="email" class="form-control" id="email_field" placeholder="ejemplo@mail.com" required="required">
                    </div>
                    <div class="form-group">
                        <label for="telefono_field">Teléfono</label>
                        <input type="text" class="form-control" id="telefono_field" placeholder="########" required="required">
                    </div>
                    <div class="form-group">
                        <label for="provincia_dropdown">Provincia</label>
                        <div class="dropdown_provincia">
                            <button class="btn btn-default dropdown-toggle" type="button" id="provincia_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required="required">
                                Provincia
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="provincia_dropdown">
                                <li><a href="#">San José</a></li>
                                <li><a href="#">Alajuela</a></li>
                                <li><a href="#">Cartago</a></li>
                                <li><a href="#">Heredia</a></li>
                                <li><a href="#">Guanacaste</a></li>
                                <li><a href="#">Puntarenas</a></li>
                                <li><a href="#">Limón</a></li>
                             </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="canton_dropdown">Cantón</label>
                        <div class="dropdown_canton">
                            <button class="btn btn-default dropdown-toggle" type="button" id="canton_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required="required">
                                Cantón
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="canton_dropdown">
                                <li><a href="#">Cantón 1</a></li>
                                <li><a href="#">Cantón 2</a></li>
                                <li><a href="#">Cantón 3</a></li>
                                <li><a href="#">Cantón 4</a></li>
                                <li><a href="#">Cantón 5</a></li>
                             </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="direccion_field">Dirección</label>
                        <textarea class="form-control" rows="3" id="direccion_field" required="required"></textarea>
                    </div>
                    <div class="col-md-4 col-md-offset-4">
                        <input class="btn btn-default" type="submit" value="Siguiente">
                    </div>
                </form>
            </div>    
        </div>
    @endsection
    
    @section('categorias')
        <div class="row">
            <div class="col-md-12">
                <h3>Categorías</h3>
            </div>
           <div class="col-md-4 col-md-offset-4">
                <form class="form-horizontal">
                <h5>Seleccione las categorías en las que participará</h5>
                    <div class="form-group">
                        <div class="checkbox">
                            <div class="form-group">
                                <label>
                                    <input type="checkbox"> Categoría 1
                                </label>
                            </div>
                            <div class="form-group">
                            <label>
                                <input type="checkbox"> Categoría 2
                            </label>
                            </div>
                            <div class="form-group">
                            <label>
                                <input type="checkbox"> Categoría 3
                            </label>
                            </div>
                            <div class="form-group">
                            <label>
                                <input type="checkbox"> Categoría 4
                            </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-4">
                        <input class="btn btn-default" type="submit" value="Siguiente">
                    </div>
                </form>
            </div>
        </div>
    @endsection
    
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
                        <input type="file" class="form-control-file" id="pasaporte_field" placeholder="">
                    </div>
                    <div class="form-group">    
                        <label for="cedula_arriba_field">Fotografía cédula arriba</label>
                        <input type="file" class="form-control-file" id="cedula_arriba_field" placeholder="">
                    </div>
                    <div class="form-group">    
                        <label for="cedula_abajo_field">Fotografía cédula abajo</label>
                        <input type="file" class="form-control-file" id="cedula_abajo_fiel" placeholder="">
                    </div>
                    <div class="form-group">    
                        <label for="boleta_field">Boleta Inscripción</label>
                        <input type="file" class="form-control-file" id="boleta_field" placeholder="">
                    </div>
                    <div class="form-group">    
                        <label for="pase_cantonal_field">Pase Cantonal</label>
                        <input type="file" class="form-control-file" id="pase_cantonal_field" placeholder="">
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
