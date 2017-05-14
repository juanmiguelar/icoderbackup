<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorium extends Model
{
    protected $fillable = ['nombre', 'numero_maximo_atletas', 'tipo'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
    }
}
