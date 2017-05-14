<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Inscripciones</title>
   

</head>

<body>

    <div class="container">
        @if(session('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{@session('message')}}
        </div>
        @endif
       
        <div class="page-header clearfix">
            <h1>
                <i class="glyphicon glyphicon-list-alt"></i> Inscripción Individual
            </h1>
        </div>
        <ul class="nav nav-tabs">
            <li><a data-toggle="tab" href="#personal">Información Personal</a></li>
            <li><a data-toggle="tab" href="#medica">Información Médica</a></li>
            <li><a data-toggle="tab" href="#contacto">Datos de Contacto</a></li>
            <li><a data-toggle="tab" href="#categorias">Categorías</a></li>
            <li><a data-toggle="tab" href="#documentos">Adjuntar Documentos</a></li>
        </ul>

  <div class="tab-content">
    <div id="personal" class="tab-pane fade in active">
      @yield('informacion_personal')

    </div>  
    <div id="medica" class="tab-pane fade">
      @yield('informacion_medica')

    </div> 
    <div id="contacto" class="tab-pane fade">
      @yield('datos_de_contacto')
    </div>  
    <div id="categorias" class="tab-pane fade">
        @yield('categorias')
    </div>
    <div id="documentos" class="tab-pane fade">
        @yield('documentos')
    </div>
  </div> 
       
    </div>
    
   
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->
    
    @yield('scripts')
    <script>
        $('.date-picker').datepicker();
    </script>
</body>
</html>




