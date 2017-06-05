@extends(Auth::user()->tipo)

    @section('content')
        
        <div class="page-header clearfix" >
            <h3 class="col-md-6 col-md-offset-4">
                <i class="glyphicon glyphicon-list-alt"></i> Inscripción Individual
            </h3>
        </div>
        <ul class="nav nav-tabs">
            <li class="{{ empty($tabName) || $tabName == 'buscar' ? 'active' : '' }}" ><a data-toggle="tab" href="#buscar">Buscar Persona</a></li>
            <li class="{{ empty($tabName) || $tabName == 'personal' ? 'active' : '' }}"><a data-toggle="tab" href="#personal">Información Personal</a></li>
            <li class="{{ empty($tabName) || $tabName == 'medica' ? 'active' : '' }}"><a data-toggle="tab" href="#medica">Información Médica</a></li>
            <li class="{{ empty($tabName) || $tabName == 'contacto' ? 'active' : '' }}"><a data-toggle="tab" href="#contacto">Datos de Contacto</a></li>
            <li class="{{ empty($tabName) || $tabName == 'categorias' ? 'active' : '' }}"><a data-toggle="tab" href="#categorias">Categorías</a></li>
            <li class="{{ empty($tabName) || $tabName == 'documentos' ? 'active' : '' }}"><a data-toggle="tab" href="#documentos">Adjuntar Documentos</a></li>
        </ul>
  
  <div class="tab-content">
    <div id="buscar" class="tab-pane {{ !empty($tabName) && $tabName == 'buscar' ? 'active' : '' }}">
        <div class="row">
            <div class="col-md-12">
                <h5>Buscar Persona</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
               <form action="{{URL::to('/') }}/buscarPadron" method="GET">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

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
                        <label for="cedula">Cédula o Pasaporte</label>
                        <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Cédula o Pasaporte" required="required">
                    </div>
                    <input class="btn btn-default" type="submit" value="Buscar">
                </form>   
            </div>
        </div>  
     </div> 
    <div id="personal" class="tab-pane {{ !empty($tabName) && $tabName == 'personal' ? 'active' : '' }}">
        <div class="row">
            <div class="col-md-12">
                <h5>Información Personal</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <form action="{{URL::to('/') }}/storePersonal" method="GET">
                    
                    <div class="form-group">    
                        <label for="nombre_field">Nombre</label>
                        @if($active == 1)
                        <input type="text" class="form-control" id="nombre_field" name="nombre_field" value="{{$informacion_personal[0]->nombre1 }} " placeholder="Nombre" required="required">
                        @elseif($active == 2)
                        <input type="text" class="form-control" id="nombre_field" name="nombre_field" value="{{$persona->nombre1 }} " placeholder="Nombre" required="required">
                        @else
                        <input type="text" class="form-control" id="nombre_field" name="nombre_field"  placeholder="Nombre" required="required">
                        @endif
                    </div>
                    
                    <div class="form-group">    
                         <label for="apellido1_field">Primer Apellido</label>
                          @if($active == 1)
                          <input type="text" class="form-control" id="apellido1_field" name="apellido1_field" value="{{$informacion_personal[0]->apellido1}}" placeholder="Primer Apellido " required="required">
                          @elseif($active == 2)
                          <input type="text" class="form-control" id="apellido1_field" name="apellido1_field" value="{{$persona->apellido1}}" placeholder="Primer Apellido " required="required">
                          @else
                          <input type="text" class="form-control" id="apellido1_field" name="apellido1_field" placeholder="Primer Apellido " required="required">
                          @endif
                     </div>
                    <div class="form-group">   
                        <label for="apellido2_field">Segundo Apellido</label>
                         @if($active == 1)
                         <input type="text" class="form-control" id="apellido2_field" name="apellido2_field" value="{{$informacion_personal[0]->apellido2}}" placeholder="Segundo Apellido" required="required">
                         @elseif($active == 2)
                         <input type="text" class="form-control" id="apellido2_field" name="apellido2_field" value="{{$persona->apellido2}}" placeholder="Segundo Apellido" required="required">
                         @else
                         <input type="text" class="form-control" id="apellido2_field" name="apellido2_field" placeholder="Segundo Apellido" required="required">
                         
                         @endif
                    </div>  
                     <div class="form-group">   
                        <label for="fecha_nacimiento_field">Fecha Nacimiento</label>
                         @if($active == 1)
                         <input type="date" class="form-control" id="fecha_nacimiento_field" name="fecha_nacimiento_field" value="{{$informacion_personal[0]->fecha_nacimiento}}" required="required">
                         @elseif($active == 2)
                         <input type="date" class="form-control" id="fecha_nacimiento_field" name="fecha_nacimiento_field" value="{{$persona->fecha_nacimiento}}" required="required">
                         @else
                         <input type="date" class="form-control" id="fecha_nacimiento_field" name="fecha_nacimiento_field" required="required">
                         
                         @endif
                    </div>  
                      
                    <div class="col-md-4 col-md-offset-4">
                        <input class="btn btn-default" type="submit" value="Siguiente">
                    </div>
                </form>
            </div>
        </div>  

    </div>  
    <div id="medica" class="tab-pane {{ !empty($tabName) && $tabName == 'medica' ? 'active' : '' }}">
    <div class="row">
            <div class="col-md-12">
                <h5>Información Médica</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                   <form action="{{URL::to('/') }}/storeMedica" method="GET">
                    <div class="form-group">    
                        <label for="estatura_field">Estatura</label>
                        @if($active == 2)
                        <input type="text" class="form-control" id="estatura_field" name="estatura_field" value="{{$persona->estatura}}"placeholder="Estatura" required="required">
                        @else
                        <input type="text" class="form-control" id="estatura_field" name="estatura_field" placeholder="Estatura" required="required">
                        @endif
                    </div>
                    <div class="form-group">    
                        <label for="peso_field">Peso</label>
                        @if($active == 2)
                        <input type="text" class="form-control" id="peso_field" name="peso_field" value="{{$persona->peso}}" placeholder="Peso" required="required">
                        @else
                        <input type="text" class="form-control" id="peso_field" name="peso_field" placeholder="Peso" required="required">
                        @endif
                    </div>
                    
                    <div class="form-group">    
                         <label for="tipo_sangre_field">Tipo Sangre</label>
                        @if($active == 2)
                        <input type="text" class="form-control" id="tipo_sangre_field" name="tipo_sangre_field" value="{{$persona->tipo_sangre}}" placeholder="Tipo de Sangre" required="required">
                        @else 
                        <input type="text" class="form-control" id="tipo_sangre_field" name="tipo_sangre_field" placeholder="Tipo de Sangre" required="required">
                        @endif
                    </div>
                    
                    <div class="col-md-4 col-md-offset-4">
                        <input class="btn btn-default" type="submit" value="Siguiente">
                    </div>
                </form>
            </div>
        </div>

    </div> 
    <div id="contacto" class="tab-pane {{ !empty($tabName) && $tabName == 'contacto' ? 'active' : '' }}">
      <div class="row">
            <div class="col-md-12">
                <h5>Datos de Contacto</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <form action="{{URL::to('/') }}/storeContacto" method="GET">
                    <div class="form-group">
                        
                        <label class="control-label" for="email_field">Email</label>
                        @if($active == 2)
                        <input type="email" class="form-control" id="email_field" name="email_field" value="{{$persona->email}}" placeholder="ejemplo@mail.com" required="required">
                        @else
                        <input type="email" class="form-control" id="email_field" name="email_field" placeholder="ejemplo@mail.com" required="required">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="telefono_field">Teléfono</label>
                        @if($active == 2)
                        <input type="text" class="form-control" id="telefono_field" name="telefono_field"  value="{{$persona->telefono}}" placeholder="########" required="required">
                        @else
                        <input type="text" class="form-control" id="telefono_field" name="telefono_field" placeholder="########" required="required">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="provincia">Provincia</label>
                        <div class="provincia">
                                <select class="selectpicker form-control" id="provincia" name="provincia" required>
                                        @foreach($provincias as $provincia)
                                        <option value="{{$provincia->id_provincia}}">{{$provincia->nombre}}</option>
                                        @endforeach
                                </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="canton">Cantón</label>
                        <div class="canton">
                                <select class="selectpicker form-control" id="canton" name="canton" required>
                                        @if($active == 2)
                                        @foreach($cantons as $canton)
                                        <option value="{{$canton->id_canton}}" {{ $persona->id_canton == $canton->id_canton ? 'selected' : '' }}>{{$canton->nombre}}</option>
                                        @endforeach
                                        @else
                                        @foreach($cantons as $canton)
                                        <option value="{{$canton->id_canton}}">{{$canton->nombre}}</option>
                                        @endforeach
                                        @endif
                                </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="direccion_field">Dirección</label>
                        @if($active == 2)
                        <textarea class="form-control" rows="3" id="direccion_field" name="direccion_field" required="required">{{$persona->direccion}}</textarea>
                        @else
                        <textarea class="form-control" rows="3" id="direccion_field" name="direccion_field" required="required"></textarea>
                        @endif 
                    </div>
                    <div class="col-md-4 col-md-offset-4">
                        <input class="btn btn-default" type="submit" value="Siguiente">
                    </div>
                </form>
            </div>    
        </div>
    </div>  
    <div id="categorias" class="tab-pane {{ !empty($tabName) && $tabName == 'categorias' ? 'active' : '' }}">
      <div class="row">
            <div class="col-md-12">
                <h5>Categorías</h5>
            </div>
           <div class="col-md-12">
                <form action="{{URL::to('/') }}/storeCategorias" method="GET">
                   <div class="col-md-4 form-group">
                       <h5>Seleccione la categoría en la que participará</h5>
                        <div class="checkbox">
                            <div class="form-group">
                                <!-- Aqui deberia ir un for con categorias -->
                                @foreach($categorias as $categoria)
                                <label for="radioCategoria">
                                    <input type="radio" name="radioCategoria" value="{{$categoria->id_categoria}}" onclick="selectionCategoria(this)"> {{$categoria->nombre}}
                                </label>
                                <br/>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div  class="col-md-4 form-group">
                       <h5>Seleccione la prueba en la que participará</h5>
                        <div class="checkbox">
                            <div id="radioPrueba" id="radios" class="form-group">
                                <!-- Aqui deberia ir un for con categorias -->
                                @foreach($pruebas as $prueba)
                                <div id="radios" name="{{$prueba->id_categoria}}" style="visibility: hidden">
                                    <label for="radioPrueba">
                                        <input type="radio" name="prueba" value="{{$prueba->id_prueba}}" onclick=""> {{$prueba->nombre}}
                                    </label>
                                    <br/>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div  class="col-md-4 form-group">
                       <h5>Seleccione la rama en la que participará</h5>
                        <div class="checkbox">
                            <div id="radioRama" class="form-group">
                                <!-- Aqui deberia ir un for con categorias -->
                                @foreach($ramas as $rama)
                                <div name="{{$rama->id_categoria}}" style="visibility: hidden">
                                    <label for="radioRama" aria-hidden="true">
                                        <input type="radio" name="rama" value="{{$rama->id_rama}}" onclick=""> {{$rama->nombre}} </input>
                                    </label>
                                    <br/>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-4">
                        <input class="btn btn-default" type="submit" value="Agregar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        // Obtengo el value de la categoria seleccionada [radiobutton]
        function selectionCategoria(radio){
            
            // Volver a ocultar todoss los divs
            ocultarPruebasRamas();
            // var pruebas = document.getElementById("radioRama");
            
            var idCategoria= radio.value; // Aqui debo obtener el valor del radiobutton
            //alert(categoriaPrueba);
            // Despliego las pruebas asociadas a la categoria que seleccione
            desplegarPruebas(idCategoria);
            // Luego de seleccionar las pruebas me salen las ramas 
            desplegarRamas(idCategoria);
        }
        
        function ocultarPruebasRamas(){
            var pruebas = $('#radioPrueba').children('div');
            var ramas = $('#radioRama').children('div');
            
            for (i = 0; i < pruebas.length; i++) {
                pruebas[i].style.visibility='hidden';
                pruebas[i].style.height='0px';
            }
            
            for (i = 0; i < ramas.length; i++) {
                ramas[i].style.visibility='hidden';
                ramas[i].style.height='0px';
            }
        }
        
        function desplegarPruebas(idCategoria){
            var pruebas = document.getElementsByName(idCategoria);
            // Despliego las pruebas asociadas a categoriaPrueba
            
            for (i = 0; i < pruebas.length; i++) {
                pruebas[i].style.visibility='visible';
                pruebas[i].style.height='auto';
            }
            
        }
        
        function desplegarRamas(idCategoria){
            // Despliego las ramas asociadas a categoriaPrueba
            var pruebas = document.getElementsByName(idCategoria);
            // Despliego las pruebas asociadas a categoriaPrueba
            
            for (i = 0; i < pruebas.length; i++) {
                pruebas[i].style.visibility='visible';
                pruebas[i].style.height='auto';
            }
        }
    </script>
    
    
    <div id="documentos" class="tab-pane {{ !empty($tabName) && $tabName == 'documentos' ? 'active' : '' }}">
         <div class="row">
            <div class="col-md-12">
                <h5>Adjuntar Documentos</h5>
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
    </div>
  </div>
 @endsection
