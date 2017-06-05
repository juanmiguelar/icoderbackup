<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Canton;
use App\Provincium;
use Illuminate\Http\Request;
use \Session;
class CantonController extends Controller

{
	/**
	 * Variable to model
	 *
	 * @var canton
	 */
	protected $model;
	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public

	function __construct(Canton $model)
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
		$cantons = Canton::obtenerCantones();
		$provincias = Provincium::obtenerProvincias();
		return view('cantons.index', compact('cantons', 'provincias'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public

	function create()
	{
		$provincias = Provincium::obtenerProvincias();
		return view('cantons.create', compact('provincias'));
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
		$this->validate($request, ['nombre' => 'required', 'provincia' => 'required']);
		$verify= Canton::validarCanton($request->input("nombre"), $request->input("provincia"));
		
		if($verify){
		
		$provincias = Provincium::obtenerProvincias();
		$canton = new Canton();
		$canton->nombre = $request->input("nombre");
		$canton->id_provincia = $request->input("provincia");
		$canton->active_flag = 1;
		
		Canton::insertarCanton($canton);
		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'Se insertó el cantón "'. $request->input("nombre") .'" con éxito.');
		return redirect()->route('cantons.index', compact('provincias'));
		}else{	
		return redirect()->back()->withErrors(['El cantón "'. $request->input("nombre") .'" ya se encuentra registrado.']);

		}
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public

	function show(Canton $canton)
	{

		// $canton = $this->model->findOrFail($id);

		return view('cantons.show', compact('canton'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public

	function edit($id_canton)
	{
		$canton = Canton::obtenerCanton($id_canton);
		$provincias = Provincium::obtenerProvincias();
		
		return view('cantons.edit', compact('canton', 'provincias'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public

	function update(Request $request, $id_canton)
	{
		$this->validate($request, ['nombre' => 'required', 'provincia' => 'required']);
		$verify= Canton::validarCanton($request->input("nombre"), $request->input("provincia"));
		
		if($verify){
		$canton = new Canton();
		$canton->nombre = $request->input("nombre");
		$canton->id_provincia = $request->input("provincia");
		Canton::editarCanton($canton, $id_canton);
		
		Session::flash('message_type', 'blue');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'El cantón "'. $request->input("nombre") .'" ha sido actualizado.');
		return redirect()->route('cantons.index');
		}else{	
			return redirect()->back()->withErrors(['El cantón "'. $request->input("nombre") .'" ya se encuentra registrado.']);

		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id_canton){
		Canton::eliminarCanton($id_canton);
		
		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'El cantón se ha eliminado con éxito');
		return redirect()->route('cantons.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public

	function reactivate(Canton $canton)
	{
		$canton->active_flag = 1;
		$canton->save();
		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Canton ' . $canton->name . ' was Re-Activated.');
		return redirect()->route('cantons.index');
	}
}


