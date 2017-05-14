<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscribe extends Model
{
    protected $fillable = ['anno', 'cedula_persona'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
        }
}
