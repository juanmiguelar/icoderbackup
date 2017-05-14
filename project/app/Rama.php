<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rama extends Model
{
    protected $fillable = ['id_rama', 'nombre'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
        }
}
