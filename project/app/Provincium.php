<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincium extends Model
{
    protected $fillable = ['nombre'];

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
}
