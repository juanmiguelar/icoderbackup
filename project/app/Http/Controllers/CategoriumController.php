<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Categorium;
use Illuminate\Http\Request;
use \Session;

class CategoriumController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var categorium
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Categorium $model)
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
		$categorias = Categorium::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);
		$active = Categorium::where('active_flag', 1);
		return view('categorias.index', compact('categorias', 'active'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('categorias.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{
		$categorium = new Categorium();

		$categorium->name = ucfirst($request->input("name"));
		$categorium->slug = str_slug($request->input("name"), "-");
		$categorium->description = ucfirst($request->input("description"));
		$categorium->active_flag = 1;
		$categorium->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:categorias',
					 'description' => 'required'
			 ]);

		$categorium->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Categorium \"<a href='categorias/$categorium->slug'>" . $categorium->name . "</a>\" was Created.");

		return redirect()->route('categorias.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Categorium $categorium)
	{
		//$categorium = $this->model->findOrFail($id);

		return view('categorias.show', compact('categorium'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Categorium $categorium)
	{
		//$categorium = $this->model->findOrFail($id);

		return view('categorias.edit', compact('categorium'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Categorium $categorium, User $user)
	{

		$categorium->name = ucfirst($request->input("name"));
    $categorium->slug = str_slug($request->input("name"), "-");
		$categorium->description = ucfirst($request->input("description"));
		$categorium->active_flag = 1;//change to reflect current status or changed status
		$categorium->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:categorias,name,' . $categorium->id,
					 'description' => 'required'
			 ]);

		$categorium->save();

		Session::flash('message_type', 'blue');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Categorium \"<a href='categorias/$categorium->slug'>" . $categorium->name . "</a>\" was Updated.");

		return redirect()->route('categorias.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Categorium $categorium)
	{
		$categorium->active_flag = 0;
		$categorium->save();

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Categorium ' . $categorium->name . ' was De-Activated.');

		return redirect()->route('categorias.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Categorium $categorium)
	{
		$categorium->active_flag = 1;
		$categorium->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Categorium ' . $categorium->name . ' was Re-Activated.');

		return redirect()->route('categorias.index');
	}
}
