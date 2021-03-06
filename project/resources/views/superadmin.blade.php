<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>ICODER-JUEGOS NACIONALES</title>
    
    <!-- META TAGs -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
     <link href="{{ asset('css/footer.css') }}" rel="stylesheet">
     <link href="{{ asset('css/menu.css') }}" rel="stylesheet">
     
    <!-- THEMES -->
    <link rel="stylesheet" href="https://bootswatch.com/paper/bootstrap.min.css"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap-submenu.min.css') }}">
   
    @yield('css')
</head>

<body>

    <nav class="menu navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home">Juegos Nacionales</a>
            </div>
             <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        

                        <!-- Authentication Links -->
                        @if (Auth::guest())

                            <li><a href="{{ route('register') }}">Registrarse</a></li>
                        @else
                            <li><a href="/home" >{{ Auth::user()->canton() }}</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Cerrar Sesión
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>  
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        
                        <!-- Mantenimiento -->
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Mantenimientos
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('edicions.index') }}">Ediciones</a></li>
                            <li><a href="{{ route('deportes.index') }}">Deportes</a></li>
                            <li><a href="{{ route('categorias.index') }}">Categorías</a></li>
                            <li><a href="{{ route('ramas.index') }}">Ramas</a></li>
                            <li><a href="{{ route('pruebas.index') }}">Pruebas</a></li>
                            <li><a href="{{ route('provincias.index') }}">Provincias</a></li>
                            <li><a href="{{ route('cantons.index') }}">Cantones</a></li>
                            <li><a href="{{ route('personas.index') }}">Personas</a></li>
                            <li><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Inscripciones</a></li>
                    <li><a href="#">Reportes</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{@session('message')}}
        </div>
        @endif

        @yield('header')
        @yield('content')
    </div>
    <nav class="navbar navbar-default footer">
            <footer class="footer">
                <div class="container">
                    <p class="text-muted">
                        <br>© ICODER  2017<br>
                    </p>
                </div>
            </footer>
    </nav>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('dist/js/bootstrap-submenu.min.js') }}"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->
    
    @yield('scripts')
    <script>
        $('.date-picker').datepicker();
    </script>
</body>
</html>