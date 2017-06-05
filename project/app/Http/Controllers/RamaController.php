<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Rama;
use App\Categoria;
use App\Deporte;
use Illuminate\Http\Request;
use \Session;
class RamaController extends Controller

{
	/**
	 * Variable to model
	 *
	 * @var rama
	 */
	protected $model;
	
	
	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Rama $model)
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
		$ramas = Rama::showRamas();
		$categorias = Rama::showCategoriaDeporte();
		$active = Rama::where('active_flag', 1);
		return view('ramas.index', compact('ramas', 'categorias','active'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public

	function create()
	{
		$categorias = Rama::showCategoriaDeporte();
		return view('ramas.create', compact('categorias'));
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
		$verify = Rama::validarRama($request->input("nombre"), $request->input("categoria"));
		
		if ($verify) {
			
		$rama = new Rama();
		$rama->nombre = $request->input("nombre");
		$rama->id_categoria = $request->input("categoria");
		
		Rama::insertarRama($rama);
		
		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "La rama ha sido creada");
		
		return redirect()->route('ramas.index');
		
		}else{
			
		return redirect()->back()->withErrors(['La rama "'. $request->input("nombre") .'" ya existe en esta categoría.']);
		
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public

	function show(Rama $rama)
	{

		// $rama = $this->model->findOrFail($id);

		return view('ramas.show', compact('rama'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public

	function edit(Rama $rama)
	{

		$categorias = Rama::showCategoriaDeporte();
		return view('ramas.edit', compact('rama','categorias'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public

	function update(Request $request, Rama $rama, User $user)
	{
			$verify = Rama::validarRama($request->input("nombre"), $request->input("categoria"));
			
			if ($verify) {
			$ramanueva = new Rama();
			$ramanueva->id_rama = $rama->id_rama;
			$ramanueva->nombre = $request->input("nombre");
			$ramanueva->id_categoria = $request->input("categoria");
			$userid = $request->user()->id;
			
			Rama::editarRama($ramanueva, $userid);
			
			Session::flash('message_type', 'success');
			Session::flash('message_icon', 'checkmark');
			Session::flash('message_header', 'Success');
			Session::flash('message', "La rama ha sido editada.");
			return redirect()->route('ramas.index');
			}else{
			return redirect()->back()->withErrors(['La rama "'. $request->input("nombre") .'" ya existe en esta categoría.']);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Rama $rama)
	{
		$rama->active_flag = 0;
		$rama->save();
		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'La rama ha sido eliminada.');
		return redirect()->route('ramas.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public

	function reactivate(Rama $rama)
	{
		$rama->active_flag = 1;
		$rama->save();
		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Rama ' . $rama->name . ' was Re-Activated.');
		return redirect()->route('ramas.index');
	}
}