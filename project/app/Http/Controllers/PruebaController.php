<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Prueba;
use App\Categoria;
use App\Deporte;

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
		$categorias = Categoria::showCategorias();
		$deportes = Deporte::showDeportes();
		
		$active = Prueba::where('active_flag', 1);
		return view('pruebas.index', compact('pruebas','categorias','deportes', 'active'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('pruebas.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{
		$prueba = new Prueba();

		$prueba->name = ucfirst($request->input("name"));
		$prueba->slug = str_slug($request->input("name"), "-");
		$prueba->description = ucfirst($request->input("description"));
		$prueba->active_flag = 1;
		$prueba->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:pruebas',
					 'description' => 'required'
			 ]);

		$prueba->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Prueba \"<a href='pruebas/$prueba->slug'>" . $prueba->name . "</a>\" was Created.");

		return redirect()->route('pruebas.index');
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
		//$prueba = $this->model->findOrFail($id);

		return view('pruebas.edit', compact('prueba'));
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

		$prueba->name = ucfirst($request->input("name"));
    $prueba->slug = str_slug($request->input("name"), "-");
		$prueba->description = ucfirst($request->input("description"));
		$prueba->active_flag = 1;//change to reflect current status or changed status
		$prueba->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:pruebas,name,' . $prueba->id,
					 'description' => 'required'
			 ]);

		$prueba->save();

		Session::flash('message_type', 'blue');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Prueba \"<a href='pruebas/$prueba->slug'>" . $prueba->name . "</a>\" was Updated.");

		return redirect()->route('pruebas.index');
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
		Session::flash('message', 'The Prueba ' . $prueba->name . ' was De-Activated.');

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
