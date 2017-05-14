<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Persona;
use Illuminate\Http\Request;
use \Session;

class PersonaController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var persona
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Persona $model)
	{
		$this->model = $model;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$personas = Persona::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);
		$active = Persona::where('active_flag', 1);
		return view('personas.index', compact('personas', 'active'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('personas.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{
		$persona = new Persona();

		$persona->name = ucfirst($request->input("name"));
		$persona->slug = str_slug($request->input("name"), "-");
		$persona->description = ucfirst($request->input("description"));
		$persona->active_flag = 1;
		$persona->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:personas',
					 'description' => 'required'
			 ]);

		$persona->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Persona \"<a href='personas/$persona->slug'>" . $persona->name . "</a>\" was Created.");

		return redirect()->route('personas.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Persona $persona)
	{
		//$persona = $this->model->findOrFail($id);

		return view('personas.show', compact('persona'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Persona $persona)
	{
		//$persona = $this->model->findOrFail($id);

		return view('personas.edit', compact('persona'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Persona $persona, User $user)
	{

		$persona->name = ucfirst($request->input("name"));
    $persona->slug = str_slug($request->input("name"), "-");
		$persona->description = ucfirst($request->input("description"));
		$persona->active_flag = 1;//change to reflect current status or changed status
		$persona->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:personas,name,' . $persona->id,
					 'description' => 'required'
			 ]);

		$persona->save();

		Session::flash('message_type', 'blue');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Persona \"<a href='personas/$persona->slug'>" . $persona->name . "</a>\" was Updated.");

		return redirect()->route('personas.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Persona $persona)
	{
		$persona->active_flag = 0;
		$persona->save();

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Persona ' . $persona->name . ' was De-Activated.');

		return redirect()->route('personas.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Persona $persona)
	{
		$persona->active_flag = 1;
		$persona->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Persona ' . $persona->name . ' was Re-Activated.');

		return redirect()->route('personas.index');
	}
	
	
	public function agregarPersona($cedula_persona, $nombre1, $nombre2, $apellido1, $apellido2, $fecha_nacimiento, $nacionalidad, $telefono, $direccion, $estatura, $peso, $tipo_sangre, $tipo, $email, $cedula_frente, $cedula_atras, $boleta_inscripcion){
		$persona =	new Persona();
		$persona->cedula_persona = $cedula_persona;
		$persona->nombre1 = $nombre1;
		$persona->nombre2 = $nombre2;
		$persona->apellido1 = $apellido1;
		$persona->apellido2 = $apellido2;
		$persona->fecha_nacimiento = $fecha_nacimiento;
		$persona->nacionalidad = $nacionalidad;
		$persona->telefono = $telefono;
		$persona->direccion = $direccion;
		$persona->estatura = $estatura;
		$persona->peso = $peso;
		$persona->tipo_sangre = $tipo_sangre;
		$persona->tipo = $tipo;
		$persona->email = $email;
		$persona->cedula_frente = $cedula_frente;
		$persona->cedula_atras = $cedula_atras;
		$persona->boleta_inscripcion = $boleta_inscripcion;
		
		Persona::agregarPersona($persona);
		//falta un return acá
	}
}
