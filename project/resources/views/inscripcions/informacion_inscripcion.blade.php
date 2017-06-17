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
                </br>
                <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Buscar Persona</h5>  
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                               <form action="{{URL::to('/') }}/buscarPadron" method="GET">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                                    <div class="form-group">
                                        <label for="dropdownidentificacion">Tipo Identificación</label>
                                        
                                        <div class="dropdown_identificacion">
                                            <select class="form-control" id="identificacion" name="identificacion">
                                                <option value="cedula" >Cédula</option>
                                                <option value="pasaporte" >Pasaporte</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label for="cedula">Cédula o Pasaporte</label>
                                        <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Cédula o Pasaporte" required="required">
                                    </div>
                                    <div class="col-md-4 col-md-offset-4">
                                        <input class="btn btn-success" type="submit" value="Buscar">    
                                    </div>
                                </form>   
                            </div>
                        </div> 
                    </div>
                </div>
                </div>
            </div>
         </div> 
        
        <div id="personal" class="tab-pane {{ !empty($tabName) && $tabName == 'personal' ? 'active' : '' }}">
            <div class="row">
                </br>
                <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                       <h5>Información Personal</h5>
                    </div>
                    <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{URL::to('/') }}/storePersonal" method="GET">
                                <div class="col-md-4">
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
                                </div>
                                <div class="col-md-4">
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
                                        <label for="sexo_field">Sexo</label>
                                        
                                       @if($active == 2)
                                           <div class="radio">
                                                <label>
                                                <input type="radio" name="sexo_field" id="hombre_field" value="Hombre" {{$persona->sexo == "Hombre" ? 'checked' : '' }}>
                                                Hombre
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                <input type="radio" name="sexo_field" id="mujer_field" value="Mujer"{{$persona->sexo == "Mujer" ? 'checked' : '' }} >
                                                Mujer
                                            </label>
                                            </div>
                                        @else
                                           <div class="radio">
                                                <label>
                                                <input type="radio" name="sexo_field" id="hombre_field" value="Hombre" >
                                                Hombre
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                <input type="radio" name="sexo_field" id="mujer_field" value="Mujer">
                                                Mujer
                                            </label>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group"> 
                                        
                                    
                                        <label for="fecha_nacimiento_field">Fecha Nacimiento</label>
                                         @if($active == 1)
                                         <div class="input-group date" data-provide="datepicker">
                                            <input type="date" class="form-control" id="fecha_nacimiento_field" name="fecha_nacimiento_field" data-date-format="YYYY-MM-DD" value="{{$informacion_personal[0]->fecha_nacimiento}}" required>
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </div>
                                         </div>
                                         @elseif($active == 2)
                                         <div class="input-group date" data-provide="datepicker">
                                            <input type="date" class="form-control" id="fecha_nacimiento_field" name="fecha_nacimiento_field" data-date-format="YYYY-MM-DD" value="{{$persona->fecha_nacimiento}}" required>
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </div>
                                         </div>
                                         @else
                                         <input type="date" class="form-control" id="fecha_nacimiento_field" name="fecha_nacimiento_field" required="required">
                                         
                                         @endif
                                    </div>
                                </div>
                                  
                                <div class="col-md-5 col-md-offset-5">
                                    <input class="btn btn-success" type="submit" value="Siguiente">
                                </div>
                            </form>
                        </div>
                    </div>    
                    </div>
                </div>
                </div>
            </div>
        </div>  
        
        <div id="medica" class="tab-pane {{ !empty($tabName) && $tabName == 'medica' ? 'active' : '' }}">
            <div class="row">
                </br>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5>Información Médica</h5>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{URL::to('/') }}/storeMedica" method="GET">
                                        <div class="col-md-4 col-md-offset-2">
                                            <div class="form-group col-md-4">
                                                <label for="estatura_field">Estatura</label>
                                                @if($active == 2)
                                                <input type="number" step="0.01" min="0" class="form-control" id="estatura_field" name="estatura_field" value="{{$persona->estatura}}"placeholder="Estatura" required="required">
                                                @elseif($active == 0)
                                                <input type="number" step="0.01" min="0" class="form-control" id="estatura_field" name="estatura_field" placeholder="Estatura" required="required" disabled>
                                                @else
                                                <input type="number" step="0.01" min="0" class="form-control" id="estatura_field" name="estatura_field" placeholder="Estatura" required="required">
                                                @endif
                                                <div class="input-group-addon">Centímetros</div>
                                            </div>
                                            <div class="form-group  col-md-4">    
                                                <label for="peso_field">Peso</label>
                                                @if($active == 2)
                                                <input type="number" step="0.01" min="0" class="form-control" id="peso_field" name="peso_field" value="{{$persona->peso}}" placeholder="Peso" required="required">
                                                @elseif($active == 0)
                                                <input type="number" step="0.01"  min="0" class="form-control" id="peso_field" name="peso_field" placeholder="Peso" required="required" disabled>
                                                @else
                                                <input type="number" step="0.01" min="0" class="form-control" id="peso_field" name="peso_field" placeholder="Peso" required="required">
                                                @endif
                                                <div class="input-group-addon">Kilogramos</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">    
                                                <label for="tipo_sangre_field">Tipo Sangre</label>
                                                @if($active == 2)
                                                <div class="tipo_sangre">
                                                    <select class="selectpicker form-control" id="tipo_sangre_field" name="tipo_sangre_field" required>
                                                        <option value="A Positivo" {{$persona->tipo_sangre == "A Positivo" ? 'selected' : '' }}>A Positivo</option>
                                                        <option value="A Negativo" {{$persona->tipo_sangre == "A Negativo" ? 'selected' : '' }}>A Negativo</option>
                                                        <option value="B Positivo" {{$persona->tipo_sangre == "B Positivo" ? 'selected' : '' }}>B Positivo</option>
                                                        <option value="B Negativo" {{$persona->tipo_sangre == "B Negativo" ? 'selected' : '' }}>B Negativo</option>
                                                        <option value="AB Positivo" {{$persona->tipo_sangre == "AB Positivo" ? 'selected' : '' }}>AB Positivo</option>
                                                        <option value="AB Negativo" {{$persona->tipo_sangre == "AB Negativo" ? 'selected' : '' }}>AB Negativo</option>
                                                        <option value="O Positivo" {{$persona->tipo_sangre == "O Positivo" ? 'selected' : '' }}>O Positivo</option>
                                                        <option value="O Negativo" {{$persona->tipo_sangre == "O Negativo" ? 'selected' : '' }}>O Negativo</option>
                                                    </select>
                                                </div>
                                                @elseif($active == 0)
                                                <div class="tipo_sangre">
                                                    <select class="selectpicker form-control" id="tipo_sangre_field" name="tipo_sangre_field" required disabled>
                                                        <option value="A Positivo">A Positivo</option>
                                                        <option value="A Negativo">A Negativo</option>
                                                        <option value="B Positivo">B Positivo</option>
                                                        <option value="B Negativo">B Negativo</option>
                                                        <option value="AB Positivo">AB Positivo</option>
                                                        <option value="AB Negativo">AB Negativo</option>
                                                        <option value="O Positivo">O Positivo</option>
                                                        <option value="O Negativo">O Negativo</option>
                                                    </select>
                                                </div>
                                                @else 
                                                <div class="tipo_sangre">
                                                        <select class="selectpicker form-control" id="tipo_sangre_field" name="tipo_sangre_field" required>
                                                            <option value="A Positivo">A Positivo</option>
                                                            <option value="A Negativo">A Negativo</option>
                                                            <option value="B Positivo">B Positivo</option>
                                                            <option value="B Negativo">B Negativo</option>
                                                            <option value="AB Positivo">AB Positivo</option>
                                                            <option value="AB Negativo">AB Negativo</option>
                                                            <option value="O Positivo">O Positivo</option>
                                                            <option value="O Negativo">O Negativo</option>
                                                        </select>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-md-offset-5">
                                            @if($active == 0)
                                            <input class="btn btn-success" type="submit" value="Siguiente" disabled>
                                            @else
                                            <input class="btn btn-success" type="submit" value="Siguiente">
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        
        <div id="contacto" class="tab-pane {{ !empty($tabName) && $tabName == 'contacto' ? 'active' : '' }}">
            <div class="row">
                </br>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          <h5>Datos de Contacto</h5>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{URL::to('/') }}/storeContacto" method="GET">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label" for="email_field">Email</label>
                                                @if($active == 2)
                                                <input type="email" class="form-control" id="email_field" name="email_field" value="{{$persona->email}}" placeholder="ejemplo@mail.com" required="required">
                                                @elseif($active == 0)
                                                <input type="email" class="form-control" id="email_field" name="email_field" placeholder="ejemplo@mail.com" required="required" disabled>
                                                @else
                                                <input type="email" class="form-control" id="email_field" name="email_field" placeholder="ejemplo@mail.com" required="required">
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="telefono_field">Teléfono</label>
                                                @if($active == 2)
                                                <input type="text" class="form-control" id="telefono_field" name="telefono_field"  value="{{$persona->telefono}}" placeholder="########" required="required">
                                                @elseif($active == 0)
                                                <input type="text" class="form-control" id="telefono_field" name="telefono_field" placeholder="########" required="required" disabled>
                                                @else
                                                <input type="text" class="form-control" id="telefono_field" name="telefono_field" placeholder="########" required="required">
                                                @endif
                                            </div>    
                                        </div>
                                        <div class="col-md-4">
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
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="direccion_field">Dirección</label>
                                                @if($active == 2)
                                                <textarea class="form-control" rows="3" id="direccion_field" name="direccion_field" required="required">{{$persona->direccion}}</textarea>
                                                @else
                                                <textarea class="form-control" rows="3" id="direccion_field" name="direccion_field" required="required"></textarea>
                                                @endif 
                                            </div>    
                                        </div>
                                        
                                        <div class="col-md-5 col-md-offset-5">
                                            @if($active == 0)
                                            <input class="btn btn-success" type="submit" value="Siguiente" disabled>
                                            @else
                                            <input class="btn btn-success" type="submit" value="Siguiente">
                                            @endif
                                        </div>
                                    </form>
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        
        <div id="categorias" class="tab-pane {{ !empty($tabName) && $tabName == 'categorias' ? 'active' : '' }}">
            <div class="row">
                </br>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5>Inscripción de pruebas</h5>
                            <p>Por favor seleccione la categoría, prueba y rama para inscrbir a la persona</p>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <form action="{{URL::to('/') }}/storeCategoria" method="GET">
                                    <div class="col-md-4 form-group">
                                       <h5>Categoría</h5>
                                        <div class="checkbox">
                                            <div class="form-group">
                                                <!-- Aqui deberia ir un for con categorias -->
                                                @foreach($categorias as $categoria)
                                                <label for="radioCategoria">
                                                    <input type="radio" name="radioCategoria" value="{{$categoria->id_categoria}}" onclick="selectionCategoria(this)" required="required" > {{$categoria->nombre}}
                                                </label>
                                                <br/>
                                                @endforeach
                                            </div>
                                        </div>
                                   </div>
                                    <div  class="col-md-4 form-group">
                                       <h5>Prueba</h5>
                                        <div class="checkbox">
                                            <div id="radioPrueba" id="radios" class="form-group">
                                                <!-- Aqui deberia ir un for con categorias -->
                                                @foreach($pruebas as $prueba)
                                                <div id="radios" name="{{$prueba->id_categoria}}" style="visibility: hidden">
                                                    <label for="radioPrueba">
                                                        <input type="radio" name="prueba" value="{{$prueba->id_prueba}}" required="required"> {{$prueba->nombre}}
                                                    </label>
                                                    <br/>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                  </div>
                                    <div  class="col-md-4 form-group">
                                       <h5>Rama</h5>
                                        <div class="checkbox">
                                            <div id="radioRama" class="form-group">
                                                <!-- Aqui deberia ir un for con categorias -->
                                                @foreach($ramas as $rama)
                                                @if($active == 2)
                                                @if ($persona->sexo == "Mujer" && $rama->nombre =="Masculino")
                                                     <div name="{{$rama->id_categoria}}" style="visibility: hidden">
                                                        <label for="radioRama" aria-hidden="true">
                                                            
                                                            <input type="radio" name="rama" value="{{$rama->id_rama}}" required="required" disabled="disabled"> {{$rama->nombre}} </input>
                                                        </label>
                                                        <br/>
                                                    </div>
                                                @elseif ($persona->sexo == "Hombre" && $rama->nombre =="Femenino")
                                                    <div name="{{$rama->id_categoria}}" style="visibility: hidden">
                                                        <label for="radioRama" aria-hidden="true">
                                                            
                                                            <input type="radio" name="rama" value="{{$rama->id_rama}}" required="required" disabled="disabled"> {{$rama->nombre}} </input>
                                                        </label>
                                                        <br/>
                                                    </div>
                                                @else
                                                    <div name="{{$rama->id_categoria}}" style="visibility: hidden">
                                                        <label for="radioRama" aria-hidden="true">
                                                            
                                                            <input type="radio" name="rama" value="{{$rama->id_rama}}" required="required"> {{$rama->nombre}} </input>
                                                        </label>
                                                        <br/>
                                                    </div>
                                                @endif
                                                @else
                                                <div name="{{$rama->id_categoria}}" style="visibility: hidden">
                                                        <label for="radioRama" aria-hidden="true">
                                                            
                                                            <input type="radio" name="rama" value="{{$rama->id_rama}}" required="required"> {{$rama->nombre}} </input>
                                                        </label>
                                                        <br/>
                                                  </div>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                  </div>
                                  <div class="col-md-4 col-md-offset-4">
                                        @if($active == 0)
                                        <input class="btn btn-success" type="submit" value="Agregar" disabled>
                                        @else
                                        <input class="btn btn-success" type="submit" value="Agregar">
                                        @endif
                                  </div>
                                </form>
                                <form action="{{URL::to('/') }}/storeCategorias" method="GET">
                                    <div class="col-md-4">
                                        @if($active == 0)
                                        <input class="btn btn-success" type="submit" value="Siguiente" disabled>
                                        @else
                                        <input class="btn btn-success" type="submit" value="Siguiente">
                                        @endif
                                    </div>
                                </form>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5><i class="glyphicon glyphicon-th-list"></i> Inscripción a pruebas
                            </h5>
                        </div>
                        @if($active ==2)  
                            @if($inscripcions->count())
                                <table class="table table-condensed table-striped">
                                    <thead>
                                        <tr>
                                            <th>Categoría</th>
                                            <th>Prueba</th>
                                            <th>Rama</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($inscripcions as $inscripcion)
                                            <tr>
                                                <td>{{$inscripcion->categoria_nombre}}</td> 
                                                <td>{{$inscripcion->prueba_nombre}}</td> 
                                                <td>{{$inscripcion->rama_nombre}}</td> 
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {!! $inscripcions->render() !!}
                            @else
                                <h3 class="text-center alert alert-info">No se ha inscrito en ninguna prueba</h3>
                            @endif
                        @endif
                    </div>     
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
                </br>
                <div class="col-md-12"> 
                <div class="panel panel-default">
                    <div class="panel-heading">
                      <h5>Adjuntar Documentos</h5>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-6 pull-left">
                            <img src="{{URL::to('/')}}{{isset($persona->cedula_frente) ? $persona->cedula_frente : '/images/noimage.png'}}" alt="" class="img-responsive">
                            <img src="{{URL::to('/')}}{{isset($persona->cedula_frente) ? $persona->cedula_frente : '/images/noimage.png'}}" alt="" class="img-responsive">
                            <img src="{{URL::to('/')}}{{isset($persona->cedula_frente) ? $persona->cedula_frente : '/images/noimage.png'}}" alt="" class="img-responsive">
                            <img src="{{URL::to('/')}}{{isset($persona->cedula_frente) ? $persona->cedula_frente : '/images/noimage.png'}}" alt="" class="img-responsive">
                            <img src="{{URL::to('/')}}{{isset($persona->cedula_frente) ? $persona->cedula_frente : '/images/noimage.png'}}" alt="" class="img-responsive">
                            <img src="{{URL::to('/')}}{{isset($persona->cedula_frente) ? $persona->cedula_frente : '/images/noimage.png'}}" alt="" class="img-responsive">
                        </div>
                        <div class="col-md-6">
                            <form  action="{{URL::to('/') }}/storeArchivos"  method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="col-md-4">
                                        <div class="form-group">    
                                            <label for="pasaporte_field">Fotografía Pasaporte</label>
                                            @if($active == 2)
                                            <input type="file" style="color:transparent;" class="form-control-file" id="pasaporte_field" name="pasaporte_field" placeholder="">
                                            <label for="pasaporte_field">{{$persona->pasaporte}}</label>
                                            @elseif($active == 0)
                                            <input type="file" class="form-control-file" id="pasaporte_field" name="pasaporte_field"  placeholder="" disabled>
                                            @else
                                            <input type="file" class="form-control-file" id="pasaporte_field" name="pasaporte_field"  placeholder="">
                                            @endif
                                        </div>
                                    
                                        <div class="form-group">    
                                            <label for="cedula_frente_field">Fotografía cédula arriba</label>
                                            @if($active == 2)
                                            <input type="file" style="color:transparent;" class="form-control-file" id="cedula_frente_field" name="cedula_frente_field"  placeholder="">
                                            <label for="pasaporte_field">{{$persona->cedula_frente}}</label>
                                            @elseif($active == 0)
                                            <input type="file" class="form-control-file" id="cedula_frente_field" name="cedula_frente_field"  placeholder="" disabled>
                                            @else
                                            <input type="file" class="form-control-file" id="cedula_frente_field" name="cedula_frente_field"  placeholder="">
                                            @endif
                                        </div>
                                </div>
                                    <div class="col-md-4">
                                        <div class="form-group">    
                                            <label for="cedula_atras_field">Fotografía cédula atrás</label>
                                            @if($active == 2)
                                            <input type="file" style="color:transparent;" class="form-control-file" id="cedula_atras_field" name="cedula_atras_field"  placeholder="">
                                            <label for="pasaporte_field">{{$persona->cedula_atras}}</label>
                                            @elseif($active == 0)
                                            <input type="file" class="form-control-file" id="cedula_atras_field" name="cedula_atras_field"  placeholder="" disabled>
                                            @else
                                            <input type="file" class="form-control-file" id="cedula_atras_field" name="cedula_atras_field"  placeholder="">
                                            @endif
                                        </div>
                                        <div class="form-group">    
                                            <label for="boleta_field">Boleta Inscripción</label>
                                            @if($active == 2)
                                            <input type="file" style="color:transparent;" class="form-control-file" id="boleta_field" name="boleta_field"  placeholder="">
                                            <label for="pasaporte_field">{{$persona->boleta_inscripcion}}</label>
                                            @elseif($active == 0)
                                            <input type="file" class="form-control-file" id="boleta_field" name="boleta_field"  placeholder="" disabled>
                                            @else
                                            <input type="file" class="form-control-file" id="boleta_field" name="boleta_field"  placeholder="">
                                            @endif
                                        </div>
                                </div>
                                    <div class="col-md-4">
                                        <div class="form-group">    
                                            <label for="pase_cantonal_field">Pase Cantonal</label>
                                            @if($active == 2)
                                            <input type="file" style="color:transparent;" class="form-control-file"  id="pase_cantonal_field" name="pase_cantonal_field" placeholder="">
                                            <label for="pasaporte_field">pendiente este feature </label>
                                            @elseif($active == 0)
                                            <input type="file" class="form-control-file" id="pase_cantonal_field" name="pase_cantonal_field" placeholder="" disabled>
                                            @else
                                            <input type="file" class="form-control-file" id="pase_cantonal_field" name="pase_cantonal_field" placeholder="">
                                            @endif
                                        </div>
                                </div>
                                </div>
                                <div class="col-md-4">
                                    @if($active == 0)
                                    <input class="btn btn-success" type="submit" value="Guardar" disabled>
                                    @else
                                    <input class="btn btn-success" type="submit" value="Guardar">
                                    @endif
                                    </div>
                            </form>
                            <form  action="{{URL::to('/') }}/finalizarInscripcion"  method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="col-md-4">
                                    @if($active == 0)
                                    <input class="btn btn-success" type="submit" value="Finalizar" disabled>
                                    @else
                                    <input class="btn btn-success" type="submit" value="Finalizar">
                                    @endif
                                </div>
                            </form>
                            <form  action="{{URL::to('/') }}/cancelarInscripcion"  method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <div class="col-md-4">
                                    @if($active == 0)
                                    <a  class="btn btn-success" href="{{ url('/home')}}" >Cancelar</a>
                                    @else
                                    <a class="btn btn-success" href="{{ url('/home') }}" >Cancelar</a>
                                    @endif
                                </div> 
                            </form>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
 @endsection
