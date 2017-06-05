<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rama extends Model
{
    protected $fillable = ['id_rama', 'nombre'];
    
    protected $primaryKey = 'id_rama';

    public function Author(){
      return $this->belongsTo('App\User','author_id');
        }
    
    public static function showRama($id_rama) {
         
       $rama =  Rama::where('id_rama', $id_rama)->first();
    
       return $rama;
    }
    
    public static function showRamas() {
         
       $ramas = Rama::where('active_flag', 1)->orderBy('id_categoria', 'desc')->paginate(10);
		
       return $ramas;
      }
      
    public static function showCategoriaDeporte(){
        $categorias =  \DB::table('categorias')->join('deportes', 'categorias.id_deporte','=', 'deportes.id_deporte')
		                                    ->select('deportes.nombre as deporNombre','categorias.id_categoria','categorias.nombre')->get();
        return $categorias;
 
    }  
    
    public static function insertarRama($rama){
        
      \DB::table ('ramas')->insert(['id_categoria' => $rama->id_categoria, 'nombre' => $rama->nombre,'active_flag'=> 1,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
      
    }
    
    public static function editarRama($rama, $userid){
       \DB::table('ramas')
            ->where('id_rama', $rama->id_rama)
            ->update(['nombre' => $rama->nombre, 'id_categoria' => $rama->id_categoria, 'author_id' => $userid, 'updated_at' => date('Y-m-d H:i:s')]);
     }
      
    public static function validarRama($nombre, $id_categoria){
        $cantidad = Rama::where('nombre', $nombre)->where('id_categoria', $id_categoria)->count();
        return $cantidad == 0;
      }
     
}
