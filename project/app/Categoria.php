<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['id_categoria', 'nombre', 'edad_inicio', 'edad_final', 'anno_inicio', 'anno_final'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
    }
}