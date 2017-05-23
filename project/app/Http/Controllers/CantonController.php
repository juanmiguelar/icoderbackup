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
	public function __construct(Canton $model)
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
		$cantons = Canton::obtenerCantones();
		
		$provincias = Provincium::obtenerProvincias();
		
		return view('cantons.index', compact('cantons', 'provincias'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
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
	public function store(Request $request, User $user)
	{
		$canton = new Canton();

		$canton->nombre = $request->input("description");
		$canton->active_flag = 1;
		
		$this->validate($request, [
					 'nombre' => 'required'
			 ]);

		$canton->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Canton \"<a href='cantons/$canton->slug'>" . $canton->name . "</a>\" was Created.");

		return redirect()->route('cantons.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Canton $canton)
	{
		//$canton = $this->model->findOrFail($id);

		return view('cantons.show', compact('canton'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Canton $canton)
	{
		$canton = $this->model->findOrFail($id);

		return view('cantons.edit', compact('canton'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Canton $canton, User $user)
	{

		$canton->name = ucfirst($request->input("name"));
    	$canton->slug = str_slug($request->input("name"), "-");
		$canton->description = ucfirst($request->input("description"));
		$canton->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:cantons,name,' . $canton->id_canton,
					 'description' => 'required'
			 ]);

		$canton->save();

		Session::flash('message_type', 'blue');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Canton \"<a href='cantons/$canton->slug'>" . $canton->name . "</a>\" was Updated.");

		return redirect()->route('cantons.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Canton $canton)
	{
		$canton->active_flag = 0;
		$canton->save();

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Canton ' . $canton->name . ' was De-Activated.');

		return redirect()->route('cantons.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Canton $canton)
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
