<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    protected $fillable = ['id_prueba', 'nombre'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
        }
        
     
    public static function showPrueba($id_prueba) {
         
       $prueba =  Rama::where('id_rama', $id_prueba)->first();
    
       return $prueba;
    }
    
    public static function showPruebas() {
         
       $pruebas = Prueba::where('active_flag', 1)->orderBy('id_prueba', 'desc')->paginate(10);
		
       return $pruebas;
      }
}
