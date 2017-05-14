<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deportistum extends Model
{
    protected $fillable = ['pase_cantonal'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
    }
    
    
    public function insertarDeporte($deporte){
            \DB::table ('deportes')->insert(['id_deporte' => $deporte->cedula_persona, 'nombre1' => $deporte->nombre1, 'nombre2' => $deporte->nombre2, 'apellido1' => $deporte->apellido1, 'apellido2'=> $deporte->apellido2,  'fecha_nacimiento' => $deporte->fecha_nacimiento, 'nacionalidad' => $deporte->nacionalidad, 'telefono' => $deporte->telefono, 'direccion' => $deporte->direccion, 'estatura' => $deporte->estatura, 'peso' => $deporte->peso, 'tipo_sangre' => $deporte->tipo_sangre, 'tipo' => $deporte->tipo, 'email' => $deporte->email, 'cedula_frente' => $deporte->cedula_frente, 'cedula_atras' => $deporte->cedula_atras, 'boleta_inscripcion' => $deporte->boleta_inscripcion]);
    }
}
