<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deporte extends Model
{
    protected $fillable = ['nombre', 'numero_maximo_atletas', 'tipo','id_deporte'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
        }
        
    public function insertarDeporte($deporte){
      \DB::table ('deportes')->insert(['nombre' => $deporte->nombre, 'tipo' => $deporte->tipo, 'numero_maximo_atletas' => $deporte->numero_maximo_atletas]);
    }
}
