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
	public function index()
	{
		$ramas = Rama::showRamas();
		$categorias = Categoria::showCategorias();
		$deportes = Deporte::showDeportes();
		$active = Rama::where('active_flag', 1);
		return view('ramas.index', compact('ramas','categorias','deportes', 'active'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('ramas.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{
		$rama = new Rama();

		$rama->name = ucfirst($request->input("name"));
		$rama->slug = str_slug($request->input("name"), "-");
		$rama->description = ucfirst($request->input("description"));
		$rama->active_flag = 1;
		$rama->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:ramas',
					 'description' => 'required'
			 ]);

		$rama->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Rama \"<a href='ramas/$rama->slug'>" . $rama->name . "</a>\" was Created.");

		return redirect()->route('ramas.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Rama $rama)
	{
		//$rama = $this->model->findOrFail($id);

		return view('ramas.show', compact('rama'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Rama $rama)
	{
		//$rama = $this->model->findOrFail($id);

		return view('ramas.edit', compact('rama'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Rama $rama, User $user)
	{

		$rama->name = ucfirst($request->input("name"));
    $rama->slug = str_slug($request->input("name"), "-");
		$rama->description = ucfirst($request->input("description"));
		$rama->active_flag = 1;//change to reflect current status or changed status
		$rama->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:ramas,name,' . $rama->id,
					 'description' => 'required'
			 ]);

		$rama->save();

		Session::flash('message_type', 'blue');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Rama \"<a href='ramas/$rama->slug'>" . $rama->name . "</a>\" was Updated.");

		return redirect()->route('ramas.index');
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
		Session::flash('message', 'The Rama ' . $rama->name . ' was De-Activated.');

		return redirect()->route('ramas.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Rama $rama)
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
