<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Canton extends Model
{
    protected $fillable = ['id_canton','nombre'];
    
    public static function obtenerCanton($id_canton) {
        $canton =  Canton::where('id_canton', $id_canton)->first();
    
        return $canton;     
    }
    
    public static function obtenerCantones() {
        $lista_cantones =  Canton::where('active_flag', 1)->orderBy('id_canton', 'desc')->paginate(10);
        return $lista_cantones;     
    }
    
    public static function insertarCanton($canton){
        
      \DB::table ('cantons')->insert(['id_provincia' => $canton->id_provincia, 'nombre' => $canton->nombre,'active_flag'=> 1,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
      
    }
    
    public static function eliminarCanton($id_canton){
          \DB::table('cantons')
            ->where('id_canton', $id_canton)
            ->update(['active_flag' => '0' ]);
    }
    
    public static function editarCanton($canton, $id_canton){
        \DB::table('cantons')
            ->where('id_canton', $id_canton)
            ->update(['nombre' => $canton->nombre, 'id_provincia' => $canton->id_provincia ]);
        
    }
    
    
    public static function validarCanton($nombre, $provincia){
      $cantidad = Canton::where('nombre', $nombre)->where('id_provincia', $provincia)->count();
      return $cantidad == 0;
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
