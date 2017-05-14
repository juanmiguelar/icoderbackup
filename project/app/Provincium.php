<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincium extends Model
{
    protected $fillable = ['nombre'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
        }
}
