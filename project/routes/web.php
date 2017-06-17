<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::resource("cantons","CantonController");
Route::resource("categorias","CategoriaController");
Route::resource("deportistas","DeportistumController");
Route::resource("edicions","EdicionController");
Route::resource("provincias","ProvinciumController");
Route::resource("usuarios","UsuarioController");
Route::resource("personas","PersonaController");
Route::resource("inscribes","InscribeController");
Route::resource("inscripcions","InscripcionController");
Route::resource("pruebas","PruebaController");
Route::resource("ramas","RamaController");

/*DEPORTES*/
Route::resource("deportes","DeporteController");

Route::post("ingresar_deporte/", array("as"=>"dashboard","uses"=>"DeporteController@ingresar_deporte"));

/* Fijo aqui estan declaradas las routes del login y registro */
Auth::routes();

Route::resource('home', 'HomeController');

//PERSONAS
Route::post("agregarPersona/{cedula_persona}/{nombre1}/{nombre2}/{apellido1}/{apellido2}/{fecha_nacimiento}/{nacionalidad}/{telefono}/{direccion}/{estatura}/{peso}/{tipo_sangre}/{tipo}/{email}/{cedula_frente}/{cedula_atras}/{boleta_inscripcion}", array("as"=>"dashboard", "uses"=>"PersonaController@agregarPersona"));


//EDICIONES
Route::post("nueva_edicion/", array("as"=>"dashboard","uses"=>"EdicionController@store"));

//USUARIO
Route::get("editar_privilegio/{id}", array("as"=>"dashboard","uses"=>"UsuarioController@showEditarPrivilegio"));
Route::get("store_editar_privilegio/{id}", array("as"=>"dashboard","uses"=>"UsuarioController@editarPrivilegio"));


//INSCRIPCION INDIVIDUAL
Route::get("index_inscripcion/{id}", array("as"=>"dashboard","uses"=>"InscripcionController@index_inscripcion"));
Route::get("inscripcion_individual/{id}", array("as"=>"dashboard","uses"=>"InscripcionController@individual"));

Route::get("buscarPadron", array("as"=>"dashboard","uses"=>"InscripcionController@buscarPadron"));
Route::get("storePersonal", array("as"=>"dashboard","uses"=>"InscripcionController@storePersonal"));
Route::get("storeMedica", array("as"=>"dashboard","uses"=>"InscripcionController@storeMedica"));
Route::get("storeContacto", array("as"=>"dashboard","uses"=>"InscripcionController@storeContacto"));
Route::get("storeCategoria", array("as"=>"dashboard","uses"=>"InscripcionController@storeCategoria"));
Route::get("storeCategorias", array("as"=>"dashboard","uses"=>"InscripcionController@storeCategorias"));
Route::post("storeArchivos", array("as"=>"dashboard","uses"=>"InscripcionController@subirArchivos"));
Route::post("finalizarInscripcion", array("as"=>"dashboard","uses"=>"InscripcionController@finalizarInscripcion"));
Route::get("cancelarInscripcion", array("as"=>"dashboard","uses"=>"InscripcionController@storeCategorias"));


//INSCRIPCION GRUPAL
Route::get("inscripcion_grupal/{id}", array("as"=>"dashboard","uses"=>"InscripcionController@grupal"));
Route::post("leerArchivo", array("as"=>"dashboard","uses"=>"InscripcionController@leerArchivo"));




//RUTA
//Route::get("usuarios_equipos/{correo}", array("as"=>"dashboard","uses"=>"UsuarioController@mostrarEquiposRelacionados"));
//Route::post("buscarPorNombreApellido", array("as"=>"dashboard","uses"=>"UsuarioController@buscarPorNombreApellido"));
//Route::get('/home', 'InscribeController@individual')->name('home');
