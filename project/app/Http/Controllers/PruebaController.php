<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Prueba;
use App\Categoria;
use App\Rama;

use Illuminate\Http\Request;
use \Session;

class PruebaController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var prueba
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Prueba $model)
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
		$pruebas = Prueba::showPruebas();
		$categorias = Rama::showCategoriaDeporte();
		
		$active = Prueba::where('active_flag', 1);
		return view('pruebas.index', compact('pruebas','categorias', 'active'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$categorias = Rama::showCategoriaDeporte();
		return view('pruebas.create', compact('categorias'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
			$verify = Prueba::validarPrueba($request->input("nombre"), $request->input("categoria"));
			
			if ($verify) {
				$prueba = new Prueba();
				$prueba->nombre = $request->input("nombre");
				$prueba->id_categoria = $request->input("categoria");
		
				$this->validate($request, [
							 'nombre' => 'required',
							 'categoria' => 'required'
					 ]);
		
				Prueba::insertarPrueba($prueba);
		
				Session::flash('message_type', 'success');
				Session::flash('message_icon', 'checkmark');
				Session::flash('message_header', 'Success');
				Session::flash('message', "Se ha insertado la prueba con éxito");
		
				return redirect()->route('pruebas.index');
			}else{
			return redirect()->back()->withErrors(['La prueba "'. $request->input("nombre") .'" ya existe en esta categoría.']);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Prueba $prueba)
	{
		//$prueba = $this->model->findOrFail($id);

		return view('pruebas.show', compact('prueba'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Prueba $prueba)
	{
		$categorias = Rama::showCategoriaDeporte();
		return view('pruebas.edit', compact('prueba', 'categorias'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Prueba $prueba, User $user)
	{

			$verify = Prueba::validarPrueba($request->input("nombre"), $request->input("categoria"));
			
			if ($verify) {
			$pruebanueva = new Prueba();
			$pruebanueva->id_prueba = $prueba->id_prueba;
			$pruebanueva->nombre = $request->input("nombre");
			$pruebanueva->id_categoria = $request->input("categoria");
			$userid = $request->user()->id;
			
			Prueba::editarPrueba($pruebanueva, $userid);
			
			Session::flash('message_type', 'success');
			Session::flash('message_icon', 'checkmark');
			Session::flash('message_header', 'Success');
			Session::flash('message', "La prueba ha sido editada.");
			return redirect()->route('pruebas.index');
			}else{
			return redirect()->back()->withErrors(['La prueba "'. $request->input("nombre") .'" ya existe en esta categoría.']);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Prueba $prueba)
	{
		$prueba->active_flag = 0;
		$prueba->save();

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'La prueba ha sido eliminada.');

		return redirect()->route('pruebas.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Prueba $prueba)
	{
		$prueba->active_flag = 1;
		$prueba->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Prueba ' . $prueba->name . ' was Re-Activated.');

		return redirect()->route('pruebas.index');
	}
}
