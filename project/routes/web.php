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

Route::get("ver_deporte/{id_deporte}", array("as"=>"dashboard","uses"=>"DeporteController@show"));
Route::post("ingresar_deporte/", array("as"=>"dashboard","uses"=>"DeporteController@ingresar_deporte"));


/* Fijo aqui estan declaradas las routes del login y registro */
Auth::routes();

Route::resource('home', 'HomeController');
Route::get("inscripcion_individual", array("as"=>"dashboard","uses"=>"InscribeController@individual"));

//PERSONAS
Route::post("agregarPersona/{cedula_persona}/{nombre1}/{nombre2}/{apellido1}/{apellido2}/{fecha_nacimiento}/{nacionalidad}/{telefono}/{direccion}/{estatura}/{peso}/{tipo_sangre}/{tipo}/{email}/{cedula_frente}/{cedula_atras}/{boleta_inscripcion}", array("as"=>"dashboard", "uses"=>"PersonaController@agregarPersona"));


//EDICIONES
Route::post("nueva_edicion/", array("as"=>"dashboard","uses"=>"EdicionController@store"));

//RUTA
//Route::get("usuarios_equipos/{correo}", array("as"=>"dashboard","uses"=>"UsuarioController@mostrarEquiposRelacionados"));
//Route::post("buscarPorNombreApellido", array("as"=>"dashboard","uses"=>"UsuarioController@buscarPorNombreApellido"));
//Route::get('/home', 'InscribeController@individual')->name('home');
