<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Edicion extends Model
{
    protected $fillable = ['lugar', 'fecha_inicio', 'fecha_fin', 'fecha_inscripcion', 'fecha_fin_inscripcion'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
        }
}
