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
}
