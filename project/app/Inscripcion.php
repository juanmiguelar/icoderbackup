<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;

class Inscripcion extends Model
{
    protected $fillable = ['id_inscripcion'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
    }
    
    public static function insertarInscripcion($persona, $id_deporte){
    \DB::table ('inscripcions')->insert([
                                        'id_persona' => $persona->id_persona, 
                                        'id_deporte' => $id_deporte, 
                                        'fecha' => date('Y-m-d H:i:s'),
                                        'author_id' => Auth::user()->id,
                                        'active_flag'=> 1]);
    }
    public static function agregarInscripcionPruebaCategoria($id_inscripcion, $id_categoria, $id_rama, $id_prueba){
      \DB::table ('inscripcion_prueba_categoria')->insert([
                                        'id_inscripcion' => $id_inscripcion, 
                                        'id_prueba' => $id_prueba, 
                                        'id_categoria' => $id_categoria,
                                        'id_rama' => $id_rama]);
    }
      
    public static function showInscripcion($id_persona) {
         
       $inscripcion = Inscripcion::where('id_persona', $id_persona)->first();
		
       return $inscripcion;
    }
    public static function showDeportistasIncritosDeporte($deporte, $edicion, $canton){
      
      $deportista =  \DB::table('deportista')
                                      // Uno con la tabla inscripcions para poder llegar al deporte
                                    ->join('inscripcions', 'deportista.id_persona','=', 'inscripcions.id_persona')
                                      // Uno con la tabla de personas para poder llegar a la edición
                                    ->join('personas', 'deportista.id_persona','=', 'personas.id_persona')
                                     // Uno con la tabla de deporte para poder sacar el nombre del deporte
                                     // y sacar solo los asociados a un deporte
                                    ->join('deportes', 'deportes.id_deporte','=', 'inscripcions.id_deporte')
                                     // Uno con la tabla inscribes para poder llegar al año de la edición
                                    ->join('inscribes', 'inscribes.id_persona', '=', 'personas.id_persona')
		                                  ->select('*')
		                                      // Filtrar por el nombre del deporte
		                                    ->where('deportes.nombre', '=', $deporte)
		                                      // Filtrar por el nombre del canton
		                                    ->where('personas.id_canton','=', $canton)
		                                      // Filtrar por el año de la edición
		                                    ->where('inscribes.anno', '=', $edicion)->get();
    }
    
    
    public static function insertarInscribes($persona, $edicion){
    \DB::table ('inscribes')->insert([
                                        'anno' => $edicion,
                                        'id_persona' => $persona, 
                                        'author_id' => Auth::user()->id,
                                        'active_flag'=> 1,
                                        'created_at' => date('Y-m-d H:i:s'), 
                                        'updated_at' => date('Y-m-d H:i:s')
                                        ]);
    }
    
    public static function showPruebasRamaCategoriaInscrita($id_deporte, $persona){
      
      $inscripcions =  \DB::table('inscripcions')
                                    ->join('inscripcion_prueba_categoria', 'inscripcion_prueba_categoria.id_inscripcion','=', 'inscripcions.id_inscripcion')
                                    ->join('categorias', 'categorias.id_categoria','=', 'inscripcion_prueba_categoria.id_categoria')
                                    ->join('pruebas', 'pruebas.id_prueba','=', 'inscripcion_prueba_categoria.id_prueba')
                                    ->join('ramas', 'ramas.id_rama', '=', 'inscripcion_prueba_categoria.id_rama')
		                                ->select('categorias.nombre as categoria_nombre', 'pruebas.nombre as prueba_nombre', 'ramas.nombre as rama_nombre')
		                                    ->where('inscripcions.id_deporte', '=', $id_deporte)
		                                    ->where('inscripcions.id_persona','=', $persona->id_persona)->paginate(5);
		  return $inscripcions;
    }
    public static function validarInscripcionPruebaCategoria($id_inscripcion, $id_categoria, $id_rama, $id_prueba) {
         
       $inscripcion = \DB::table('inscripcion_prueba_categoria')
		                              ->select('*')
		                              ->where('id_inscripcion', '=', $id_inscripcion)
		                              ->where('id_rama', '=', $id_rama)
		                              ->where('id_prueba', '=',  $id_prueba)
		                              ->where('id_categoria','=', $id_categoria)->get();
	
       return $inscripcion;
    }
}
