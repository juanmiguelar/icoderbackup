<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    protected $fillable = ['id_prueba', 'nombre'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
        }
}
