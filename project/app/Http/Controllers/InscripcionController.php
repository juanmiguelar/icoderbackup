<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Inscripcion;
use Illuminate\Http\Request;
use \Session;

class InscripcionController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var inscripcion
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Inscripcion $model)
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
		$inscripcions = Inscripcion::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);
		$active = Inscripcion::where('active_flag', 1);
		return view('inscripcions.index', compact('inscripcions', 'active'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('inscripcions.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{
		$inscripcion = new Inscripcion();

		$inscripcion->name = ucfirst($request->input("name"));
		$inscripcion->slug = str_slug($request->input("name"), "-");
		$inscripcion->description = ucfirst($request->input("description"));
		$inscripcion->active_flag = 1;
		$inscripcion->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:inscripcions',
					 'description' => 'required'
			 ]);

		$inscripcion->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Inscripcion \"<a href='inscripcions/$inscripcion->slug'>" . $inscripcion->name . "</a>\" was Created.");

		return redirect()->route('inscripcions.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Inscripcion $inscripcion)
	{
		//$inscripcion = $this->model->findOrFail($id);

		return view('inscripcions.show', compact('inscripcion'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Inscripcion $inscripcion)
	{
		//$inscripcion = $this->model->findOrFail($id);

		return view('inscripcions.edit', compact('inscripcion'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Inscripcion $inscripcion, User $user)
	{

		$inscripcion->name = ucfirst($request->input("name"));
    $inscripcion->slug = str_slug($request->input("name"), "-");
		$inscripcion->description = ucfirst($request->input("description"));
		$inscripcion->active_flag = 1;//change to reflect current status or changed status
		$inscripcion->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:inscripcions,name,' . $inscripcion->id,
					 'description' => 'required'
			 ]);

		$inscripcion->save();

		Session::flash('message_type', 'blue');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Inscripcion \"<a href='inscripcions/$inscripcion->slug'>" . $inscripcion->name . "</a>\" was Updated.");

		return redirect()->route('inscripcions.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Inscripcion $inscripcion)
	{
		$inscripcion->active_flag = 0;
		$inscripcion->save();

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Inscripcion ' . $inscripcion->name . ' was De-Activated.');

		return redirect()->route('inscripcions.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Inscripcion $inscripcion)
	{
		$inscripcion->active_flag = 1;
		$inscripcion->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Inscripcion ' . $inscripcion->name . ' was Re-Activated.');

		return redirect()->route('inscripcions.index');
	}
}
