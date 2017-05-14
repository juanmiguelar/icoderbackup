@extends('layout_tabs')

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
                        <label class="control-label" for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" placeholder="Teléfono">
                    </div>
                    <div class="form-group">
                        <label for="dropdownprovincia">Provincia</label>
                        <div class="dropdown_provincia">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownprovincia" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Provincia
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownprovincia">
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
                        <label for="canton">Cantón</label>
                        <div class="dropdown_canton">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdowncanton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Cantón
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdowncanton">
                                <li><a href="#">Cantón 1</a></li>
                                <li><a href="#">Cantón 2</a></li>
                                <li><a href="#">Cantón 3</a></li>
                                <li><a href="#">Cantón 4</a></li>
                                <li><a href="#">Cantón 5</a></li>
                             </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <textarea class="form-control" rows="3" id="direccion"></textarea>
                    </div>
                    <div class="col-md-4 col-md-offset-4">
                        <input class="btn btn-default" type="submit" value="Guardar">
                    </div>
                </form>
            </div>    
        </div>
    @endsection