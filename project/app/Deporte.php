<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Deporte extends Model
{
    protected $fillable = ['nombre', 'numero_maximo_atletas', 'tipo','id_deporte'];
    
    protected $primaryKey = 'id_deporte';

    public function Author(){
      return $this->belongsTo('App\User','author_id');
        }
        
    public static function insertarDeporte($deporte, $userid){
      \DB::table ('deportes')->insert(['nombre' => $deporte->nombre, 'tipo' => $deporte->tipo, 'active_flag'=> 1, 'author_id' => $userid, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
    }
    
    public static function editarDeporte($deporte, $userid){
       \DB::table('deportes')
            ->where('id_deporte', $deporte->id_deporte)
            ->update(['nombre' => $deporte->nombre, 'tipo' => $deporte->tipo,'active_flag'=> 1, 'author_id' => $userid, 'updated_at' => date('Y-m-d H:i:s')]);
      }
      
      public static function showDeportes() {
         
       $deportes = Deporte::where('active_flag', 1)->orderBy('id_deporte', 'desc')->paginate(10);
		
       return $deportes;
      }
      
       public static function showDeporte($id_deporte) {
         
        $deporte =  Deporte::where('id_deporte', $id_deporte)->first();
    
        return $deporte;
      }
      
      public static function validarDeporte($nombre, $tipo){
        $cantidad = Deporte::where('nombre', $nombre)->where('tipo', $tipo)->count();
        return $cantidad == 0;
      }
    
    
}
