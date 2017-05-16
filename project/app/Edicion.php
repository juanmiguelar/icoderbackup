<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Edicion extends Model
{
    protected $fillable = ['lugar', 'fecha_inicio', 'fecha_fin', 'fecha_inscripcion', 'fecha_fin_inscripcion'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
        }
        
         public static function insertarEdicion($edicion, $userid){
      \DB::table ('edicions')->insert(['lugar' => $edicion->lugar, 'fecha_inicio' => $edicion->fecha_inicio, 'fecha_fin' => $edicion->fecha_fin, 'fecha_inscripcion' => $edicion->fecha_inscripcion, 'fecha_fin_inscripcion' => $edicion->fecha_fin_inscripcion, 'anno'=> 2018, 'active_flag'=> 1, 'author_id' => $userid, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
    }
}
