<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = ['cedula_usuario', 'nombre1', 'nombre2', 'apellido1', 'apellido2', 'tipo', 'email', 'contrasenna'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
    }
    
    public static function validarEmail(){
      
    }
}
