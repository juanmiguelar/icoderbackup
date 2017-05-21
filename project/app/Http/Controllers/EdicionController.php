<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Edicion;
use Illuminate\Http\Request;
use \Session;

class EdicionController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var edicion
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Edicion $model)
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
		$edicions = Edicion::where('active_flag', 1)->orderBy('anno', 'desc')->paginate(10);
		$active = Edicion::where('active_flag', 1);
		return view('edicions.index', compact('edicions', 'active'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$anno = date_format(date_create(date('Y-m-d H:i:s')), 'Y');
		return view('edicions.create',  compact('anno'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{
		if (edicion:: comprobarAnno($request->input("anno")) == "0"){
			
		return view('edicions.show')->withMessage("Ya existe una edición para este año, por favor verifique el año");
			
		}else{
		
		$edicion = new Edicion();
		
		$edicion->lugar = $request->input("lugar");
		$edicion->anno = $request->input("anno");
		$edicion->fecha_inicio = $request->input("fecha_inicio");
		$edicion->fecha_fin = $request->input("fecha_fin");
		$edicion->fecha_inscripcion = $request->input("fecha_inscripcion");
		$edicion->fecha_fin_inscripcion = $request->input("fecha_fin_inscripcion");
		$userid = $request->user()->id;
		
		edicion:: insertarEdicion($edicion, $userid);
			return redirect()->route('edicions.index');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($anno)
	{
		$edicion = Edicion::showEdicion($anno);
		return view('edicions.show', compact('edicion'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Edicion $edicion)
	{
		//$edicion = $this->model->findOrFail($id);

		return view('edicions.edit', compact('edicion'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Edicion $edicion, User $user)
	{

		$edicion->name = ucfirst($request->input("name"));
    $edicion->slug = str_slug($request->input("name"), "-");
		$edicion->description = ucfirst($request->input("description"));
		$edicion->active_flag = 1;//change to reflect current status or changed status
		$edicion->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:edicions,name,' . $edicion->id,
					 'description' => 'required'
			 ]);

		$edicion->save();

		Session::flash('message_type', 'blue');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Edicion \"<a href='edicions/$edicion->slug'>" . $edicion->name . "</a>\" was Updated.");

		return redirect()->route('edicions.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Edicion $edicion)
	{
		$edicion->active_flag = 0;
		$edicion->save();

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Edicion ' . $edicion->name . ' was De-Activated.');

		return redirect()->route('edicions.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Edicion $edicion)
	{
		$edicion->active_flag = 1;
		$edicion->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Edicion ' . $edicion->name . ' was Re-Activated.');

		return redirect()->route('edicions.index');
	}
}
