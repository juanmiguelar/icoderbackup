<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    protected $fillable = ['id_prueba', 'nombre'];
    
    protected $primaryKey = 'id_prueba';

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
      
      
    public static function insertarPrueba($prueba){
        
      \DB::table ('pruebas')->insert(['id_categoria' => $prueba->id_categoria, 'nombre' => $prueba->nombre,'active_flag'=> 1,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
      
    }
    
        public static function validarPrueba($nombre, $id_categoria){
        $cantidad = Prueba::where('nombre', $nombre)->where('id_categoria', $id_categoria)->count();
        return $cantidad == 0;
      }
     
         public static function editarPrueba($prueba, $userid){
       \DB::table('pruebas')
            ->where('id_prueba', $prueba->id_prueba)
            ->update(['nombre' => $prueba->nombre, 'id_categoria' => $prueba->id_categoria, 'author_id' => $userid, 'updated_at' => date('Y-m-d H:i:s')]);
     }
}
