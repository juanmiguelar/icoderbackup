<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Auth;

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
	public function Author()
		{
		return $this->belongsTo('App\User', 'author_id');
		}

	public static

	function agregarPersona($persona)
		{
		\DB::table('persona')->insert(['cedula_persona' => $persona->cedula_persona,
		                      'nombre1' => $persona->nombre1,
		                      'nombre2' => $persona->nombre2,
		                      'apellido1' => $persona->apellido1,
		                      'apellido2' => $persona->apellido2,
		                      'fecha_nacimiento' => $persona->fecha_nacimiento,
		                      'nacionalidad' => $persona->nacionalidad,
		                      'telefono' => $persona->telefono,
		                      'direccion' => $persona->direccion,
		                      'estatura' => $persona->estatura,
		                      'peso' => $persona->peso,
		                      'tipo_sangre' => $persona->tipo_sangre,
		                      'tipo' => $persona->tipo,
		                      'email' => $persona->email,
		                      'cedula_frente' => $persona->cedula_frente,
		                      'cedula_atras' => $persona->cedula_atras,
		                      'boleta_inscripcion' => $persona->boleta_inscripcion]);
		}

	public static

	function obtenerPersonas()
		{
		$personas = Persona::where('active_flag', 1)->orderBy('nombre1', 'desc')->paginate(10);
		return $personas;
		}

	public static

	function showPersona($cedula_persona)
		{
		$persona = Persona::where('cedula_persona', $cedula_persona)->first();
		return $persona;
		}


	  public static
  
	  function verificarPersona($cedula)
	  {
	  	$persona = \DB::table('personas')->where('cedula_persona', $cedula);
		return $persona;
	  }
  
	public static function desactivar($id){
		\DB::table('personas')->where('id_persona', $id)->update(['active_flag' => '0']);
	}

	public static function insertarPersona(){
		\DB::table('personas')->insert(['id_usuario' => Auth::user()->id,
		                      'cedula_persona' => session('cedula_inscripcion') ,
		                      'nombre1' => session('nombre1') ,
		                      'apellido1' => session('apellido1') ,
		                      'apellido2' => session('apellido2') ,
		                      'fecha_nacimiento' => session('fecha_nacimiento'),
		                      'created_at' => date('Y-m-d H:i:s') ,
		                      'updated_at' => date('Y-m-d H:i:s') ,
		                      'active_flag' => 1]);
	}

	public static function updatePersonal($persona){
		\DB::table('personas')->where('cedula_persona', $persona->cedula_persona)->update(['nombre1' => $persona->nombre1, 'apellido1' => $persona->apellido1, 'apellido2' => $persona->apellido2, 'fecha_nacimiento' => $persona->fecha_nacimiento]);
	}

	public static

	function updateMedica($persona)
		{
		\DB::table('personas')->where('cedula_persona', $persona->cedula_persona)->update(['estatura' => $persona->estatura, 'peso' => $persona->peso, 'tipo_sangre' => $persona->tipo_sangre]);
		}
	
	public static function updateContacto($persona){
		\DB::table('personas')->where('cedula_persona', $persona->cedula_persona)
		                     ->update(['email' => $persona->email,
		                     'id_canton' => $persona->id_canton,
		                     'telefono' => $persona->telefono, 
		                     'direccion' => $persona->direccion
		                     ]);
	}
	}

