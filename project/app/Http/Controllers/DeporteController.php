<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Deporte;
use Illuminate\Http\Request;
use \Session;

class DeporteController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var deporte
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Deporte $model)
	{
		$this->model = $model;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($nombre = "none")
	{
		if ($nombre == "none") {
			$deportes = Deporte::where('active_flag', 1)->orderBy('id_deporte', 'desc')->paginate(10);
		}else{
			$deportes = Deporte::where('active_flag', 1)->where('nombre', $nombre)->orderBy('id_deporte', 'desc')->paginate(10);
		}
		
		return view('deportes.index', compact('deportes'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('deportes.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{
		
	$verify = Deporte::validarDeporte($request->input("nombre"), $request->input("tipo"));
		
	if ($verify) {
		$deporte = new Deporte();
		$deporte->nombre = $request->input("nombre");
		$deporte->tipo = $request->input("tipo");
		$userid = $request->user()->id;
		
		Deporte:: insertarDeporte($deporte, $userid);
		
		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'El deporte ' . $deporte->nombre . ' ha sido creado exitosamente.');
		
		return redirect()->route('deportes.index');
	}else{
		return redirect()->back()->withErrors(['El deporte "'. $request->input("nombre") .'" de tipo  "'. $request->input("tipo") .'" ya existe.']);
	}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id_deporte)
	{
		
		$deporte = Deporte::where('id_deporte', $id_deporte)->first();
		
		return view('deportes.show', compact('deporte'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Deporte $deporte)
	{
		//$deporte = $this->model->findOrFail($id);

		return view('deportes.edit', compact('deporte'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, $id, User $user)
	{
	
		$verify = Deporte::validarDeporte($request->input("nombre"), $request->input("tipo"));
		
		if ($verify) {

		$deporte = Deporte::where( 'id_deporte' , $id)->first();
		$deporte->nombre = $request->input("nombre");
		$deporte->tipo = $request->input("tipo");
		$userid = $request->user()->id;
		
		Deporte:: editarDeporte($deporte, $userid);
				
		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'El deporte ' . $deporte->nombre . ' ha sido actualizado exitosamente.');		
		return redirect()->route('deportes.index');

		}else{
		return redirect()->back()->withErrors(['El deporte "'. $request->input("nombre") .'" de tipo  "'. $request->input("tipo") .'" ya existe.']);
	}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Deporte $deporte)
	{
		\DB::select("Call desactivardeporte(". $deporte->id_deporte .")");
		$categorias = \DB::table('categorias')->where('id_deporte', '=', $deporte->id_deporte)->get();
		
		// dd($categorias);
		
		foreach ($categorias as $categoria) {
			\DB::table('pruebas')
				->where('id_categoria', $categoria->id_categoria)
				->update(['active_flag' => 0]);
			
			\DB::table('ramas')
				->where('id_categoria', $categoria->id_categoria)
				->update(['active_flag' => 0]);
		}

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'El deporte ha sido eliminado.');

		
		return redirect()->route('deportes.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Deporte $deporte)
	{
		$deporte->active_flag = 1;
		$deporte->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Deporte ' . $deporte->name . ' was Re-Activated.');

		return redirect()->route('deportes.index');
	}
	
	public function insertarNuevoDeporte($deporte){
		Deporte::insertarDeporte($deporte);
	}
	
	
}
