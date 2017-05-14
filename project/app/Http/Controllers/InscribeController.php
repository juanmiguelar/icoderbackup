<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Inscribe;
use Illuminate\Http\Request;
use \Session;

class InscribeController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var inscribe
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Inscribe $model)
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
	//	$inscribes = Inscribe::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);
	//	$active = Inscribe::where('active_flag', 1);
		return view('');
	}
	
	public function individual()
	{
	//	$inscribes = Inscribe::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);
	//	$active = Inscribe::where('active_flag', 1);
			return view('inscribes.informacion_personal');

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('inscribes.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{
		$inscribe = new Inscribe();

		$inscribe->name = ucfirst($request->input("name"));
		$inscribe->slug = str_slug($request->input("name"), "-");
		$inscribe->description = ucfirst($request->input("description"));
		$inscribe->active_flag = 1;
		$inscribe->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:inscribes',
					 'description' => 'required'
			 ]);

		$inscribe->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Inscribe \"<a href='inscribes/$inscribe->slug'>" . $inscribe->name . "</a>\" was Created.");

		return redirect()->route('inscribes.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Inscribe $inscribe)
	{
		//$inscribe = $this->model->findOrFail($id);

		return view('inscribes.show', compact('inscribe'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Inscribe $inscribe)
	{
		//$inscribe = $this->model->findOrFail($id);

		return view('inscribes.edit', compact('inscribe'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Inscribe $inscribe, User $user)
	{

		$inscribe->name = ucfirst($request->input("name"));
    $inscribe->slug = str_slug($request->input("name"), "-");
		$inscribe->description = ucfirst($request->input("description"));
		$inscribe->active_flag = 1;//change to reflect current status or changed status
		$inscribe->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:inscribes,name,' . $inscribe->id,
					 'description' => 'required'
			 ]);

		$inscribe->save();

		Session::flash('message_type', 'blue');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Inscribe \"<a href='inscribes/$inscribe->slug'>" . $inscribe->name . "</a>\" was Updated.");

		return redirect()->route('inscribes.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Inscribe $inscribe)
	{
		$inscribe->active_flag = 0;
		$inscribe->save();

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Inscribe ' . $inscribe->name . ' was De-Activated.');

		return redirect()->route('inscribes.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Inscribe $inscribe)
	{
		$inscribe->active_flag = 1;
		$inscribe->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Inscribe ' . $inscribe->name . ' was Re-Activated.');

		return redirect()->route('inscribes.index');
	}
}
