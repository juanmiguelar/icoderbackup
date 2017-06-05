<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Provincium;
use Illuminate\Http\Request;
use \Session;

class ProvinciumController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var provincium
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Provincium $model)
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
		$provincias = Provincium::obtenerProvincias();
		$active = Provincium::where('active_flag', 1);
		return view('provincias.index', compact('provincias', 'active'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('provincias.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user) {
		
		$verify = Provincium::validarProvincia($request->input("nombre")); 
		
		if ($verify) {
		
			$provincium = new Provincium();
	
			$provincium->nombre =($request->input("nombre"));
			$provincium->active_flag = 1;
			$provincium->author_id = $request->user()->id;
	
	
			$provincium->save();
		
			return redirect()->route('provincias.index');
		}else{
			return redirect()->back()->withErrors(['La provincia "'. $request->input("nombre") .'" ya esta registrada.']);
		}
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id_provincia)
	{
		$provincium = Provincium::showProvinvcia($id_provincia);

		return view('provincias.show', compact('provincium'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Provincium $provincia)
	{

		return view('provincias.edit', compact('provincia'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Provincium $provincia, User $user)
	{
		$verify = Provincium::validarProvincia($request->input("nombre")); 
		
		
		if ($verify) {
			
		
			$provinciumNueva = new Provincium();
			$provinciumNueva->id_provincia = $provincia->id_provincia;
			$provinciumNueva->nombre = ($request->input("nombre"));
			$provinciumNueva->author_id = $request->user()->id;
	
	
			Provincium::editarProvincia($provinciumNueva);
		
			return redirect()->route('provincias.index');
		}else{
			return redirect()->back()->withErrors(['La provincia "'. $request->input("nombre") .'" ya esta registrada.']);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Provincium::desactivar($id);

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'La provincia ha sido eliminada.');

		return redirect()->route('provincias.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Provincium $provincium)
	{
		$provincium->active_flag = 1;
		$provincium->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Provincium ' . $provincium->name . ' was Re-Activated.');

		return redirect()->route('provincias.index');
	}
}
