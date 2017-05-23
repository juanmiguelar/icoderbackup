<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Categoria;
use App\Deporte;

use Illuminate\Http\Request;
use \Session;

class CategoriaController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var categoria
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Categoria $model)
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
		$categorias = Categoria::showCategorias();
		$deportes = Deporte::showDeportes();
		$active = Categoria::where('active_flag', 1);
		return view('categorias.index', compact('categorias','deportes', 'active'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$anno = date_format(date_create(date('Y-m-d H:i:s')), 'Y');
		 $deportes = Deporte::orderBy('id_deporte', 'desc')->paginate(10);
		return view('categorias.create',  compact('anno', 'deportes'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request, User $user)
	{
		$verify = Categoria::validarCategoria($request->input("nombre"), $request->input("deporte"));
		
			if ($verify) {
				
				if( $request->input("anno_inicio") <= $request->input("anno_fin")){
	
				$categoria = new Categoria();
				$categoria->nombre = $request->input("nombre");
		        $categoria->anno_inicio = $request->input("anno_inicio");
		        $categoria->anno_final= $request->input("anno_fin");
		        $categoria->numero_maximo_atletas = $request->input("numero_maximo_atletas");
		        $categoria->id_deporte = $request->input("deporte");
		        $categoria->active_flag = 1;
		        
		
				$categoria->save();
	
				return redirect('categorias');	
				}else{
					return redirect()->back()->withErrors(['El año Final debe ser posterior al año inicial.']);
				}
		}else{
			return redirect()->back()->withErrors(['La categoría "'. $request->input("nombre") .'" ya esta registrada en este deporte.']);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id_categoria)
	{
	
		$categoria = Categoria::showCategoria($id_categoria);
		
		return view('categorias.show', compact('categoria'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Categoria $categoria)
	{
		$anno = date_format(date_create(date('Y-m-d H:i:s')), 'Y');
		$deportes = Deporte::orderBy('id_deporte', 'desc')->paginate(10);
		return view('categorias.edit',  compact('categoria','anno', 'deportes'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Categoria $categoria, User $user)
	{
		$verify = Categoria::validarCategoria($request->input("nombre"), $request->input("deporte"));
		
			if ($verify) {
				
				if( $request->input("anno_inicio") <= $request->input("anno_fin")){
	
				$categorianueva = new Categoria();
				$categorianueva ->id_categoria= $categoria->id_categoria;
				$categorianueva ->nombre = $request->input("nombre");
		        $categorianueva ->anno_inicio = $request->input("anno_inicio");
		        $categorianueva ->anno_final= $request->input("anno_fin");
		        $categorianueva ->numero_maximo_atletas = $request->input("numero_maximo_atletas");
		        $categorianueva ->id_deporte = $request->input("deporte");
		       
		        
		
				Categoria::editarCategoria($categorianueva);
	
				return redirect('categorias');	
				}else{
					return redirect()->back()->withErrors(['El año Final debe ser posterior al año inicial.']);
				}
		}else{
			return redirect()->back()->withErrors(['La categoría "'. $request->input("nombre") .'" ya esta registrada en este deporte.']);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Categoria $categoria)
	{
		$categoria->active_flag = 0;
		$categoria->save();

		Session::flash('message_type', 'negative');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'La categoría fue eliminada');

		return redirect()->route('categorias.index');
	}

	/**
	 * Re-Activate the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reactivate(Categoria $categoria)
	{
		$categoria->active_flag = 1;
		$categoria->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The Categoria ' . $categoria->name . ' was Re-Activated.');

		return redirect()->route('categorias.index');
	}
}
