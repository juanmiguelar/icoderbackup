<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use \Session;

class UsuarioController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var usuario
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Usuario $model)
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
		$usuarios = User::showUsers();
		$active = User::where('active_flag', 1);
		
		return view('usuarios.index', compact('usuarios', 'active'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('usuarios.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{
		// Valido si el correo ya esta en el sistema
		$verify = $user->validarEmail($request->input("email"));
		
		// Si no se encuentra en el sistema
		if ($verify) {
			
			// Valido los campos
			$this->validate($request, [
		 	'nombre' => 'required',
        	'email' => 'required',
        	'contrasena' => 'required'
    		]);
    		
    		// Creo el usuario
			$user = new User();
			$user->name = $request->input("nombre");
	        $user->email = $request->input("email");
	        $user->password = $request->input("contrasena");
	        $user->tipo = $request->input("tipo");
	        $user->id_canton = 1;
	        
	        // Lo guardo
			$user->save();
			// \Flash::message('Usuario ingresado con éxito');
			return redirect('usuarios');
			
		} else {
			// \Flash::error('El correo digitado ya se encuentra en uso, intente con uno nuevo');
			return redirect()->back()->withErrors(['El correo "'. $request->input("email") .'" ya esta registrado.']); 
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Usuario $usuario)
	{
		//$usuario = $this->model->findOrFail($id);

		return view('usuarios.show', compact('usuario'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Usuario $usuario)
	{
		//$usuario = $this->model->findOrFail($id);

		return view('usuarios.edit', compact('usuario'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Usuario $usuario, User $user)
	{

		$usuario->name = ucfirst($request->input("name"));
    	$usuario->slug = str_slug($request->input("name"), "-");
		$usuario->description = ucfirst($request->input("description"));
		$usuario->active_flag = 1;//change to reflect current status or changed status
		$usuario->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:usuarios,name,' . $usuario->id,
					 'description' => 'required'
			 ]);

		$usuario->save();

		Session::flash('message_type', 'blue');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Usuario \"<a href='usuarios/$usuario->slug'>" . $usuario->name . "</a>\" was Updated.");

		return redirect()->route('usuarios.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(User $usuario)
	{
		$usuario->active_flag = 0;
		$usuario->save();

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Usuario ' . $usuario->name . ' was De-Activated.');

		return redirect()->route('usuarios.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Usuario $usuario)
	{
		$usuario->active_flag = 1;
		$usuario->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Usuario ' . $usuario->name . ' was Re-Activated.');

		return redirect()->route('usuarios.index');
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showEditarPrivilegio($id)
	{
		$usuario = User::showUser($id);
		return view('usuarios.editarPrivilegios', compact('usuario'));
	}
	public function editarPrivilegio($id)
	{
		$usuario = new User();
		$usuario->id = $id;
		$usuario->tipo = $_GET['tipo'];
		$usuario->active_flag = 1;//change to reflect current status or changed status
		
		User::editarPrivilegio($usuario);
		
		Session::flash('message_type', 'blue');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'Los privilegios se han actualizado.');

		return redirect()->route('usuarios.index');
	}
}
