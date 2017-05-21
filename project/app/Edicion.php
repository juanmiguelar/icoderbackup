<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Edicion extends Model
{
    protected $fillable = ['lugar', 'fecha_inicio', 'fecha_fin', 'fecha_inscripcion', 'fecha_fin_inscripcion'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
        }
        
    public static function insertarEdicion($edicion, $userid){
        
        // buscar si existe sino
        
      \DB::table ('edicions')->insert(['lugar' => $edicion->lugar, 'fecha_inicio' =>  date('Y-m-d', strtotime($edicion->fecha_inicio)), 'fecha_fin' => date('Y-m-d', strtotime($edicion->fecha_fin)), 'fecha_inscripcion' => date('Y-m-d', strtotime($edicion->fecha_inscripcion)), 'fecha_fin_inscripcion' => date('Y-m-d', strtotime($edicion->fecha_fin_inscripcion)), 'anno'=> $edicion->anno, 'active_flag'=> 1, 'author_id' => $userid, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
      
      // y si si
      // devolver edicion con id 0
    }
    
    public static function comprobarAnno($anno) {
        
         
        $edicion =  Edicion::where('anno', $anno)->count();
    
        return $edicion;
      }
    
    
    public static function showEdicion($anno) {
         
       $edicion =  Edicion::where('anno', $anno)->first();
    
       return $edicion;
      }
    
}
