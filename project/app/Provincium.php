<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincium extends Model
{
    protected $fillable = ['nombre'];
    
    protected $primaryKey = 'id_provincia';

    public function Author(){
      return $this->belongsTo('App\User','author_id');
        }
        
    public static function showProvincia($id_provincia) {
         
       $provincium =  Provincium::where('id_categoria', $id_provincia)->first();
    
       return $provincium;
    }
    
    public static function obtenerProvincias() {
     
        $provincias =  Provincium::where('active_flag', 1)->orderBy('id_provincia', 'desc')->paginate(10);
        
        return $provincias;     
       
    }
    
    public static function validarProvincia($nombre){
      $cantidad = Provincium::where('nombre', $nombre)->count();
      return $cantidad == 0;
    }
    
    public static function editarProvincia($provincia) {
        \DB::table('provincia')
            ->where('id_provincia', $provincia->id_provincia)
            ->update(['nombre' => $provincia->nombre,'author_id'=>$provincia->author_id,'updated_at' => date('Y-m-d H:i:s')]);
    }
    
    public static function desactivar($id){
        \DB::table('provincia')
            ->where('id_provincia', $id)
            ->update(['active_flag' => 0]);
    }
}
