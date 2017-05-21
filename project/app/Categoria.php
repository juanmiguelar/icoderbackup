<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['id_categoria', 'nombre', 'edad_inicio', 'edad_final', 'anno_inicio', 'anno_final'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
    }
    
     public static function showCategoria($id_categoria) {
         
       $categoria =  Categoria::where('id_categoria', $id_categoria)->first();
    
       return $categoria;
      }
    
    public static function showCategorias() {
         
       $categorias = Categoria::where('active_flag', 1)->orderBy('id_categoria', 'desc')->paginate(10);
		
       return $categorias;
      }
     
}
