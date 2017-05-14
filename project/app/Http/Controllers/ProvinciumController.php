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
		$provincias = Provincium::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);
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
	public function store(Request $request, User $user)
	{
		$provincium = new Provincium();

		$provincium->name = ucfirst($request->input("name"));
		$provincium->slug = str_slug($request->input("name"), "-");
		$provincium->description = ucfirst($request->input("description"));
		$provincium->active_flag = 1;
		$provincium->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:provincias',
					 'description' => 'required'
			 ]);

		$provincium->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Provincium \"<a href='provincias/$provincium->slug'>" . $provincium->name . "</a>\" was Created.");

		return redirect()->route('provincias.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Provincium $provincium)
	{
		//$provincium = $this->model->findOrFail($id);

		return view('provincias.show', compact('provincium'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Provincium $provincium)
	{
		//$provincium = $this->model->findOrFail($id);

		return view('provincias.edit', compact('provincium'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Provincium $provincium, User $user)
	{

		$provincium->name = ucfirst($request->input("name"));
    $provincium->slug = str_slug($request->input("name"), "-");
		$provincium->description = ucfirst($request->input("description"));
		$provincium->active_flag = 1;//change to reflect current status or changed status
		$provincium->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:provincias,name,' . $provincium->id,
					 'description' => 'required'
			 ]);

		$provincium->save();

		Session::flash('message_type', 'blue');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Provincium \"<a href='provincias/$provincium->slug'>" . $provincium->name . "</a>\" was Updated.");

		return redirect()->route('provincias.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Provincium $provincium)
	{
		$provincium->active_flag = 0;
		$provincium->save();

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Provincium ' . $provincium->name . ' was De-Activated.');

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
