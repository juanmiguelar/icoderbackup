<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $fillable = ['id_inscripcion'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
        }
}
