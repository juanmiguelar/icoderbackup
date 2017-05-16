<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable = ['cedula_persona',
                            'nombre1',
                            'nombre2',
                            'apellido1',
                            'apellido2',
                            'fecha_nacimiento',
                            'nacionalidad',
                            'telefono',
                            'direccion',
                            'estatura',
                            'peso',
                            'tipo_sangre',
                            'tipo',
                            'email',
                            'cedula_frente',
                            'cedula_atras',
                            'boleta_inscripcion'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
    }
        
    public static function agregarPersona($persona){
      
      \DB::table ('persona')->insert(['cedula_persona' => $persona->cedula_persona, 'nombre1' => $persona->nombre1, 'nombre2' => $persona->nombre2, 'apellido1' => $persona->apellido1, 'apellido2'=> $persona->apellido2,  'fecha_nacimiento' => $persona->fecha_nacimiento, 'nacionalidad' => $persona->nacionalidad, 'telefono' => $persona->telefono, 'direccion' => $persona->direccion, 'estatura' => $persona->estatura, 'peso' => $persona->peso, 'tipo_sangre' => $persona->tipo_sangre, 'tipo' => $persona->tipo, 'email' => $persona->email, 'cedula_frente' => $persona->cedula_frente, 'cedula_atras' => $persona->cedula_atras, 'boleta_inscripcion' => $persona->boleta_inscripcion]);
      
    }
    
    
    public static function obtenerPersonas() {
     
       $personas = Persona::where('active_flag', 1)->orderBy('nombre1', 'desc')->paginate(10);
        
        return $personas;     
       
    }
    
    public static function showPersona($cedula_persona) {
         
       $persona =  Persona::where('cedula_persona', $cedula_persona)->first();
    
       return $persona;
      }
    
    
}
