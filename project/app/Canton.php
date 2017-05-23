<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Canton extends Model
{
    protected $fillable = ['nombre'];
    
    public static function obtenerCantones() {
        $lista_cantones =  Canton::where('active_flag', 1)->orderBy('id_canton', 'desc')->paginate(10);
        return $lista_cantones;     
    }
    
    public static function insertarCanton($canton, $userid){
        
      \DB::table ('cantons')->insert(['id_provincia' => $canton->id_provincia, 'fecha_inicio' =>  date('Y-m-d', strtotime($edicion->fecha_inicio)), 'fecha_fin' => date('Y-m-d', strtotime($edicion->fecha_fin)), 'fecha_inscripcion' => date('Y-m-d', strtotime($edicion->fecha_inscripcion)), 'fecha_fin_inscripcion' => date('Y-m-d', strtotime($edicion->fecha_fin_inscripcion)), 'anno'=> $edicion->anno, 'active_flag'=> 1, 'author_id' => $userid, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
      
    }
}
   // $cantones = Array();


// if($lista_cantones != null){
            //     foreach($lista_cantones as $canton){
            //         $canton = \DB::table('cantons')
            //                     ->join('provincia', 'provincia.id_provincia', '=', 'cantons.id_provincia')
            //                     ->select('cantons.id_canton','cantons.nombre','provincia.nombre_provincia')
            //                     ->get();
                              
            //         array_push($cantones, $canton);
            //     }
            // }
            //@foreach($cantons[0] as $canton)
