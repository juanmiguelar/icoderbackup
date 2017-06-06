<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Inscripcion;
use App\Deporte;
use App\Deportistum;
use App\Persona;
use App\Provincium;
use App\Canton;
use App\Categoria;
use App\Rama;
use App\Prueba;

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
	public

	function __construct(Inscripcion $model)
		{
		$this->model = $model;
		}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public

	function index()
		{
			$inscripcions = Inscripcion::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);
			$active = Inscripcion::where('active_flag', 1);
			// Obtenemos las categorias
			$categorias = Categoria::showCategorias();
			return view('inscripcions.index', compact('inscripcions', 'active','categorias'));
		}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public

	function index_inscripcion($deporte)
		{
			
			$deportes = Deporte::showDeportes();
			$deportistas = Deportistum::show();
			// Obtenemos las categorias
			$categorias = Categoria::showCategorias();
			$deporteSeleccionado = Deporte::nombreDeporteById($deporte)->nombre;
			// dd($deporteSeleccionado);
			return view('inscripcions.index_inscripcion', 
				compact('deportistas', 'deportes', 'categorias','deporte','deporteSeleccionado'));
		}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public

	function buscarPadron()
		{
			// Si la cedula no esta vacia
		if (isset($_GET['cedula']))
			{
				// Obtengo la cedula
			$cedula = $_GET['cedula'];
				// Busco la persona en el padron electoral
			$informacion_personal = \DB::table('padron')->where('cedula', '=', $cedula)->get();
			
			 // Convertirmos la información a formato json, solo en teste caso porque no hay scaffold para padron.
			$informacion_personal = json_decode($informacion_personal);
			
			// Colocamos la información en la session.
			session(['cedula_inscripcion' => $cedula]);
			session(['nombre1' => $informacion_personal[0]->nombre1]);
			session(['apellido1' => $informacion_personal[0]->apellido1]);
			session(['apellido2' => $informacion_personal[0]->apellido2]);
			session(['fecha_nacimiento' => $informacion_personal[0]->fecha_nacimiento]);
			
			}else{
				// En caso de que no se encuentre en el padron
			}
		
		//para desplegar los valores en los inputs
		$active = 1;
		
		// Indicamos la tab a la que debe ir
		$tabName = "personal";
		
		// Colecciones para la vista
		$provincias = Provincium::obtenerProvincias();
		$cantons = Canton::obtenerCantones();
		$categorias = Categoria::showCategorias();
		$pruebas =  Prueba::showPruebas();
		$ramas =  Rama::showRamas();
		
		return view('inscripcions.informacion_inscripcion', compact('persona','provincias','cantons','categorias','pruebas','ramas','active', 'tabName'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function storePersonal(Request $request){
		$cedula = session('cedula_inscripcion');
		// Verificar si la persona en la base de datos
		// Si la persona no existe hago un insert
		
		$persona = Persona::showPersona($cedula);
		
		if ($persona == null){
		    Persona::insertarPersona();
		}else{
			//Si ya existe se hace un update con DATOS DE INFO PERSONAL
			
			$persona = new Persona();
			$persona->cedula_persona = $cedula;
		    $persona->nombre1 =$request->input("nombre_field"); 
			$persona->apellido1 = $request->input('apellido1_field');
			$persona->apellido2 = $request->input('apellido2_field');
			$persona->fecha_nacimiento = $request->input('fecha_nacimiento_field');
			Persona::updatePersonal($persona);
			
		}
		$active = 2;
		$tabName = "medica";
		
		//colecciones para la vista
		$persona = Persona::showPersona($cedula);
		$provincias = Provincium::obtenerProvincias();
		$cantons = Canton::obtenerCantones();
		$categorias = Categoria::showCategorias();
		$pruebas =  Prueba::showPruebas();
		$ramas =  Rama::showRamas();
		
		return view('inscripcions.informacion_inscripcion', compact('persona','provincias','cantons','categorias','pruebas','ramas','active', 'tabName'));
	
	}
		/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function storeMedica(Request $request){
		$cedula = session('cedula_inscripcion');
		// Verificar si la persona en la base de datos
		// Si la persona no existe hago un insert
		
		
		
		$persona = Persona::showPersona($cedula);
		
		if ($persona == null){
		    Persona::insertarPersona();
		}else{
			//Si ya existe se hace un update con DATOS DE INFO MEDICA
			
			$persona = new Persona();
			$persona->cedula_persona = $cedula;
		    $persona->estatura = $request->input("estatura_field"); 
			$persona->peso = $request->input('peso_field');
			$persona->tipo_sangre = $request->input('tipo_sangre_field');
			Persona::updateMedica($persona);
			
		}
		$active = 2;
		$tabName = "contacto";
		
		//colecciones para la vista
		$persona = Persona::showPersona($cedula);
		$provincias = Provincium::obtenerProvincias();	
		$cantons = Canton::obtenerCantones();
		$categorias = Categoria::showCategorias();
		$pruebas =  Prueba::showPruebas();
		$ramas =  Rama::showRamas();
		
		return view('inscripcions.informacion_inscripcion', compact('persona','provincias','cantons','categorias','pruebas','ramas','active', 'tabName'));
	}
    	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function storeContacto(Request $request){
		$cedula = session('cedula_inscripcion');
		// Verificar si la persona en la base de datos
		// Si la persona no existe hago un insert
		
		$persona = Persona::showPersona($cedula);
		
		if ($persona == null){
		    Persona::insertarPersona();
		}else{
			//Si ya existe se hace un update con DATOS DE INFO CONTACTO
			
			$persona = new Persona();
			$persona->cedula_persona = $cedula;
		    $persona->email = $request->input("email_field"); 
			$persona->telefono = $request->input('telefono_field');
			$persona->id_canton = $request->input('canton');
			$persona->direccion = $request->input('direccion_field');
			Persona::updateContacto($persona);
			
		}
		$active = 2;
		$tabName = "categorias";
		
		//colecciones para la vista
		$persona = Persona::showPersona($cedula);
		$provincias = Provincium::obtenerProvincias();	
		$cantons = Canton::obtenerCantones();
		$categorias = Categoria::showCategorias();
		$pruebas =  Prueba::showPruebas();
		$ramas =  Rama::showRamas();
		
		return view('inscripcions.informacion_inscripcion', compact('persona','provincias','cantons','categorias','pruebas','ramas','active', 'tabName'));
	
	}
		/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function storeCategorias(Request $request){
		$cedula = session('cedula_inscripcion');
		// Verificar si la persona en la base de datos
		// Si la persona no existe hago un insert
		
		$persona = Persona::showPersona($cedula);
		$id_categoria = $request->input("radioCategoria");
		$id_rama  = $request->input("prueba");
		$id_prueba = $request->input("rama");
		
		dd($id_categoria);
		
		if ($persona == null){
		    Persona::insertarPersona();
		}else{	
		}
		// $active = 2;
		// $tabName = "documentos";
		
		// //colecciones para la vista
		// $persona = Persona::showPersona($cedula);
		// $provincias = Provincium::obtenerProvincias();	
		// $cantons = Canton::obtenerCantones();
		// $categorias = Categoria::showCategorias();///filtrar por deporte
		// $pruebas =  Prueba::showPruebas();
		// $ramas =  Rama::showRamas();
		
		// return view('inscripcions.informacion_inscripcion', compact('persona','provincias','cantons','categorias','pruebas','ramas','active', 'tabName'));
	
		
	}
 
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public

	function create()
		{
		return view('inscripcions.create');
		}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public

	function store(Request $request, User $user)
		{
		$inscripcion = new Inscripcion();
		$inscripcion->name = ucfirst($request->input("name"));
		$inscripcion->slug = str_slug($request->input("name") , "-");
		$inscripcion->description = ucfirst($request->input("description"));
		$inscripcion->active_flag = 1;
		$inscripcion->author_id = $request->user()->id;
		$this->validate($request, ['name' => 'required|max:255|unique:inscripcions', 'description' => 'required']);
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
	public

	function show(Inscripcion $inscripcion)
		{

		// $inscripcion = $this->model->findOrFail($id);

		return view('inscripcions.show', compact('inscripcion'));
		}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public

	function edit(Inscripcion $inscripcion)
		{

		// $inscripcion = $this->model->findOrFail($id);

		return view('inscripcions.edit', compact('inscripcion'));
		}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public

	function update(Request $request, Inscripcion $inscripcion, User $user)
		{
		$inscripcion->name = ucfirst($request->input("name"));
		$inscripcion->slug = str_slug($request->input("name") , "-");
		$inscripcion->description = ucfirst($request->input("description"));
		$inscripcion->active_flag = 1; //change to reflect current status or changed status
		$inscripcion->author_id = $request->user()->id;
		$this->validate($request, ['name' => 'required|max:255|unique:inscripcions,name,' . $inscripcion->id, 'description' => 'required']);
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
	public

	function destroy(Inscripcion $inscripcion)
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
	public

	function reactivate(Inscripcion $inscripcion)
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
