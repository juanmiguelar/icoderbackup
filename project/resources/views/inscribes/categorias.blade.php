@extends('layout_tabs')

    @section('categorias')
        <div class="row">
            <div class="col-md-12">
                <h3>Categorías</h3>
            </div>
            <div class="">
                <h5>Seleccione las categorías en las que participará</h5>
                <form>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Categoría 1
                            </label>
                            <label>
                                <input type="checkbox"> Categoría 2
                            </label>
                            <label>
                                <input type="checkbox"> Categoría 3
                            </label>
                            <label>
                                <input type="checkbox"> Categoría 4
                            </label>
                        </div>
                    </div>
                </form>
                <input class="btn btn-default" type="submit" value="Guardar">
            </div>
        </div>
    @endsection