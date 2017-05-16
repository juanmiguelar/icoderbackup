<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Deportistum;
use Illuminate\Http\Request;
use \Session;

class DeportistumController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var deportistum
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Deportistum $model)
	{
		$this->model = $model;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($deporte = "none")
	{
		if ($deporte == "none") {
			$deportistas = Deportistum::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);
		}else{
			
		}
		
		return view('deportistas.index', compact('deportistas', 'active'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('deportistas.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{
		$deportistum = new Deportistum();

		$deportistum->name = ucfirst($request->input("name"));
		$deportistum->slug = str_slug($request->input("name"), "-");
		$deportistum->description = ucfirst($request->input("description"));
		$deportistum->active_flag = 1;
		$deportistum->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:deportistas',
					 'description' => 'required'
			 ]);

		$deportistum->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Deportistum \"<a href='deportistas/$deportistum->slug'>" . $deportistum->name . "</a>\" was Created.");

		return redirect()->route('deportistas.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Deportistum $deportistum)
	{
		//$deportistum = $this->model->findOrFail($id);

		return view('deportistas.show', compact('deportistum'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Deportistum $deportistum)
	{
		//$deportistum = $this->model->findOrFail($id);

		return view('deportistas.edit', compact('deportistum'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Deportistum $deportistum, User $user)
	{

		$deportistum->name = ucfirst($request->input("name"));
    	$deportistum->slug = str_slug($request->input("name"), "-");
		$deportistum->description = ucfirst($request->input("description"));
		$deportistum->active_flag = 1;//change to reflect current status or changed status
		$deportistum->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:deportistas,name,' . $deportistum->id,
					 'description' => 'required'
			 ]);

		$deportistum->save();

		Session::flash('message_type', 'blue');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Deportistum \"<a href='deportistas/$deportistum->slug'>" . $deportistum->name . "</a>\" was Updated.");

		return redirect()->route('deportistas.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Deportistum $deportistum)
	{
		$deportistum->active_flag = 0;
		$deportistum->save();

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Deportistum ' . $deportistum->name . ' was De-Activated.');

		return redirect()->route('deportistas.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Deportistum $deportistum)
	{
		$deportistum->active_flag = 1;
		$deportistum->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Deportistum ' . $deportistum->name . ' was Re-Activated.');

		return redirect()->route('deportistas.index');
	}
}
