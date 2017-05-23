<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['id_categoria', 'nombre', 'anno_inicio', 'anno_final'];
    
    protected $primaryKey = 'id_categoria';

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
      
    public static function validarCategoria($nombre, $deporte){
      $cantidad = Categoria::where('nombre', $nombre)->where('id_deporte', $deporte)->count();
      return $cantidad == 0;
    }
    
        public static function editarCategoria($categoria) {
        \DB::table('categorias')
            ->where('id_categoria', $categoria->id_categoria)
            ->update(['nombre' => $categoria->nombre,'anno_inicio'=> $categoria->anno_inicio, 'anno_final' => $categoria->anno_final, 'id_deporte' => $categoria->id_deporte, 'numero_maximo_atletas' => $categoria->numero_maximo_atletas,'updated_at' => date('Y-m-d H:i:s')]);
    }
     
}
