<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Canton;
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
	public

	function __construct(Usuario $model)
	{
		$this->model = $model;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public

	function index()
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
	public

	function create()
	{
		$cantones = Canton::all();
		return view('usuarios.create', compact('cantones'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public

	function store(Request $request, User $user)
	{

		// Verifica que el nombre no este vacio
		// Que el email sea unico en la base de datos
		// Que la contraseña no este vacia.

		$this->validate($request, ['nombre' => 'required', 'email' => 'required|email|unique:users', 'contrasena' => 'required']);
		$user = new User();
		$user->name = $request->input("nombre");
		$user->email = $request->input("email");
		$user->password = bcrypt($request->input("contrasena"));
		$user->tipo = $request->input("tipos");
		$user->id_canton = $request->input("cantones");
		$user->save();
		Session::flash('message_type', 'blue');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'Usuario ingresado con éxito.');
		return redirect('usuarios');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public

	function show(Usuario $usuario)
	{

		// $usuario = $this->model->findOrFail($id);

		return view('usuarios.show', compact('usuario'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public

	function edit(Usuario $usuario)
	{

		// $usuario = $this->model->findOrFail($id);

		$cantones = Canton::all();
		return view('usuarios.edit', compact('usuario', 'cantones'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public

	function update(Request $request, Usuario $usuario, User $user)
	{
		$verify = $user->validarEmailUpdate($request->input("email") , $usuario->id);
		if ($verify) {
			$user = new User();
			$user->id = $usuario->id;
			$user->name = $request->input("nombre");
			$user->email = $request->input("email");
			$user->tipo = $request->input("tipos");
			$user->id_canton = $request->input("cantones");
			$userid = $request->user()->id;
			User::editarUsuario($user, $userid);
			return redirect('usuarios');
		}
		else {
			return redirect()->back()->withErrors(['El correo "' . $request->input("email") . '" ya esta registrado.']);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public

	function destroy(User $usuario)
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
	public

	function reactivate(Usuario $usuario)
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
	public

	function showEditarPrivilegio($id)
	{
		$usuario = User::showUser($id);
		return view('usuarios.editarPrivilegios', compact('usuario'));
	}

	public

	function editarPrivilegio($id)
	{
		$usuario = new User();
		$usuario->id = $id;
		$usuario->tipo = $_GET['tipo'];
		$usuario->active_flag = 1; //change to reflect current status or changed status
		User::editarPrivilegio($usuario);
		Session::flash('message_type', 'blue');
		Session::flash('message_header', 'alert-danger');
		Session::flash('message', 'Los privilegios se han actualizado.');

		// EN la vista->@include('flash::message')
		// \Flash::message('Se actualizó el privilegio del Usuario');

		return redirect()->route('usuarios.index');
	}
}