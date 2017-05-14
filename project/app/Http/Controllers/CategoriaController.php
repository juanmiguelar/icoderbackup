<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Categoria;
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
		$categorias = Categoria::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);
		$active = Categoria::where('active_flag', 1);
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
		$categoria = new Categoria();

		$categoria->name = ucfirst($request->input("name"));
		$categoria->slug = str_slug($request->input("name"), "-");
		$categoria->description = ucfirst($request->input("description"));
		$categoria->active_flag = 1;
		$categoria->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:categorias',
					 'description' => 'required'
			 ]);

		$categoria->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Categoria \"<a href='categorias/$categoria->slug'>" . $categoria->name . "</a>\" was Created.");

		return redirect()->route('categorias.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Categoria $categoria)
	{
		//$categoria = $this->model->findOrFail($id);

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
		//$categoria = $this->model->findOrFail($id);

		return view('categorias.edit', compact('categoria'));
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

		$categoria->name = ucfirst($request->input("name"));
    $categoria->slug = str_slug($request->input("name"), "-");
		$categoria->description = ucfirst($request->input("description"));
		$categoria->active_flag = 1;//change to reflect current status or changed status
		$categoria->author_id = $request->user()->id;

		$this->validate($request, [
					 'name' => 'required|max:255|unique:categorias,name,' . $categoria->id,
					 'description' => 'required'
			 ]);

		$categoria->save();

		Session::flash('message_type', 'blue');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The Categoria \"<a href='categorias/$categoria->slug'>" . $categoria->name . "</a>\" was Updated.");

		return redirect()->route('categorias.index');
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
		Session::flash('message', 'The Categoria ' . $categoria->name . ' was De-Activated.');

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
