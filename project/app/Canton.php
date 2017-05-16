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
