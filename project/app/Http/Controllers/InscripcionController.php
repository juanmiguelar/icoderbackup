<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use Carbon\Carbon;

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
	 
	
	
	public	function __construct(Inscripcion $model)
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
			// Obtenemos las categorias
			$categorias = Categoria::showCategorias();
			return view('inscripcions.index', compact('inscripcions', 'active','categorias'));
		}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index_inscripcion($deporte){
			//GuardarIdDeporteSesion
			session(['id_deporte' => $deporte]);
		
			$deportes = Deporte::orderBy('id_deporte', 'desc')->get();
			$deportistas = Deportistum::show();
			
			// Obtenemos las categorias
			$categorias = Categoria::showCategorias();
			$deporteSeleccionado = Deporte::showDeporte($deporte);
			// dd($deporteSeleccionado);
			return view('inscripcions.index_inscripcion', 
				compact('deportistas', 'deportes', 'categorias','deporteSeleccionado'));
	}
		
	public function individual($deporte){
	   	
		$active=0;
		$tabName = "buscar";
		$provincias = Provincium::obtenerProvincias();
        	
		$cantons = Canton::obtenerCantones();
		$categorias = Categoria::showCategoriasDeporte(session('id_deporte'));
		$pruebas =  Prueba::showPruebas();
		$ramas =  Rama::showRamas();
		
		return view('inscripcions.informacion_inscripcion', compact('active','provincias','categorias', 'pruebas','ramas','cantons','tabName'));

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function buscarPadron(){
		// Colecciones para la vista
		$provincias = Provincium::obtenerProvincias();
		$cantons = Canton::obtenerCantones();
		$pruebas =  Prueba::showPruebas();
		$ramas =  Rama::showRamas();
					
		// Si la cedula no esta vacia
		if ( isset($_GET['cedula']) && isset($_GET['identificacion']) ){
			
			$cedula = $_GET['cedula'];
			$tipo_identificacion = $_GET['identificacion'];
			
			$persona = Persona::showPersona($cedula);
				session(['cedula_inscripcion' => $cedula]);
						
			//Si la persona no existe en la tabla PERSONA.
			//Va a validar si es por cedula o pasaporte que la busca.
			
			if($persona == null){
				
				if($tipo_identificacion == "cedula"){
				// Se busca a la persona en el padron electoral
				$informacion_personal = \DB::table('padron')->where('cedula', '=', $cedula)->get();
					
				// Se convierte información a formato json, solo en este caso.
				$informacion_personal = json_decode($informacion_personal);
				
					if($informacion_personal == null){
						$active = 0;
						Session::flash('message_type', 'success');
						Session::flash('message_icon', 'checkmark');
						Session::flash('message_header', 'Success');
						Session::flash('message', 'No existe la persona con cédula '.$_GET['cedula'].' ');
				
						// Indicamos la tab a la que debe ir
						$tabName = "buscar";
						
						// Colecciones para la vista
						$categorias = Categoria::showCategoriasDeporte(session('id_deporte'));
						return view('inscripcions.informacion_inscripcion', compact('persona','informacion_personal','provincias','cantons','categorias','pruebas','ramas','active', 'tabName'));
						
					}else{
						//El caso en que la persona si se encuentre en el padron
						//para desplegar los valores en los inputs
						$active = 1;
						
						// Indicamos la tab a la que debe ir
						$tabName = "personal";
						
						// Colecciones para la vista
						$categorias = Categoria::showCategoriasDeporte(session('id_deporte'));
						return view('inscripcions.informacion_inscripcion', compact('persona','informacion_personal','provincias','cantons','categorias','pruebas','ramas','active', 'tabName'));
							
					}
				}else{
					//Este caso es cuando es pasaporte, es decir alguna persona extrajera que no esta en padron
						//para desplegar los valores en los inputs
						$active = 0;
						
						// Indicamos la tab a la que debe ir
						$tabName = "personal";
						
						// Colecciones para la vista
						$categorias = Categoria::showCategoriasDeporte(session('id_deporte'));
						return view('inscripcions.informacion_inscripcion', compact('persona','provincias','cantons','categorias','pruebas','ramas','active', 'tabName'));
				}
			}else{
				$active = 2;
				$tabName = "personal";
				
				//colecciones para la vista
				$provincias = Provincium::obtenerProvincias();
				$cantons = Canton::obtenerCantones();
				$pruebas =  Prueba::showPruebas();
				$ramas =  Rama::showRamas();
				$fecha_nacimiento = date('Y', strtotime($persona->fecha_nacimiento));
				$categorias = Categoria::showCategoriasDeporteValidaEdad(session('id_deporte'),$fecha_nacimiento );
				$inscripcions = Inscripcion::showPruebasRamaCategoriaInscrita( session('id_deporte'),$persona);
  		
		
				return view('inscripcions.informacion_inscripcion', compact('inscripcions','persona','provincias','cantons','categorias','pruebas','ramas','active', 'tabName'));
				
			}
		}
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
		$personaDatos = new Persona();
		$personaDatos->cedula_persona = $cedula;
		$personaDatos->nombre1 =$request->input("nombre_field"); 
		$personaDatos->apellido1 = $request->input('apellido1_field');
		$personaDatos->apellido2 = $request->input('apellido2_field');
		$personaDatos->fecha_nacimiento = $request->input('fecha_nacimiento_field');
		$personaDatos->sexo = $request->input('sexo_field');
		
		
		if ($persona == null){
			//Se inserta persona nueva ya sea extranjera o nacional.
			Persona::insertarPersona($personaDatos);
		    $persona = Persona::showPersona($cedula);
		    
		    //Se crea una inscripción asociada a la persona 
		    Inscripcion::insertarInscripcion($persona, session('id_deporte'));
		    
		}else{
			//Si ya existe se hace un update con DATOS DE INFO PERSONAL
			
			Persona::updatePersonal($personaDatos);
			
		}
		$active = 2;
		$tabName = "medica";
		
		//colecciones para la vista
		$persona = Persona::showPersona($cedula);
		$provincias = Provincium::obtenerProvincias();
		$cantons = Canton::obtenerCantones();
		$inscripcions = Inscripcion::showPruebasRamaCategoriaInscrita( session('id_deporte'),$persona);
  		$fecha_nacimiento = date('Y', strtotime($persona->fecha_nacimiento));
		$categorias = Categoria::showCategoriasDeporteValidaEdad(session('id_deporte'),$fecha_nacimiento );
		$pruebas =  Prueba::showPruebas();
		$ramas =  Rama::showRamas();
	
		return view('inscripcions.informacion_inscripcion', compact('inscripcions','persona','provincias','cantons','categorias','pruebas','ramas','active', 'tabName'));
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
		    $persona = Persona::showPersona($cedula);
		    Inscripcion::insertarInscripcion($persona, session('id_deporte'));
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
		$pruebas =  Prueba::showPruebas();
		$ramas =  Rama::showRamas();
		$fecha_nacimiento = date('Y', strtotime($persona->fecha_nacimiento));
		$categorias = Categoria::showCategoriasDeporteValidaEdad(session('id_deporte'),$fecha_nacimiento );
		$inscripcions = Inscripcion::showPruebasRamaCategoriaInscrita( session('id_deporte'),$persona);
  		
		
		return view('inscripcions.informacion_inscripcion', compact('inscripcions','persona','provincias','cantons','categorias','pruebas','ramas','active', 'tabName'));
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
		    $persona = Persona::showPersona($cedula);
		    Inscripcion::insertarInscripcion($persona, session('id_deporte'));
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
		$pruebas =  Prueba::showPruebas();
		$ramas =  Rama::showRamas();
		$fecha_nacimiento = date('Y', strtotime($persona->fecha_nacimiento));
		$categorias = Categoria::showCategoriasDeporteValidaEdad(session('id_deporte'),$fecha_nacimiento );
		$inscripcions = Inscripcion::showPruebasRamaCategoriaInscrita( session('id_deporte'),$persona);
  		
		return view('inscripcions.informacion_inscripcion', compact('inscripcions','persona','provincias','cantons','categorias','pruebas','ramas','active', 'tabName'));
	
	}
		/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function storeCategoria(Request $request){
		///validar no inscribirse en la misma 
		//validar genero
		
		//Se toma la cedula de la sesión necesaria para consultas a la BD
		$cedula = session('cedula_inscripcion');
		
		//colecciones para la vista
		$persona = Persona::showPersona($cedula);
		$provincias = Provincium::obtenerProvincias();	
		$cantons = Canton::obtenerCantones();
		$pruebas =  Prueba::showPruebas();
		$ramas =  Rama::showRamas();
		$fecha_nacimiento = date('Y', strtotime($persona->fecha_nacimiento));
		$categorias = Categoria::showCategoriasDeporteValidaEdad(session('id_deporte'),$fecha_nacimiento );
		
		//Colecciones para la vista
		$id_categoria = $request->input("radioCategoria");
		$id_rama  = $request->input("prueba");
		$id_prueba = $request->input("rama");
		$categoria = Categoria::showCategoria($id_categoria);
		$inscripcion = Inscripcion::showInscripcion($persona->id_persona);
		$inscripcions = Inscripcion::showPruebasRamaCategoriaInscrita( session('id_deporte'),$persona);
  		
		//Se agrega una inscripcion de prueba, rama y categoria
		Inscripcion::agregarInscripcionPruebaCategoria($inscripcion->id_inscripcion,$id_categoria, $id_rama, $id_prueba);
	        
	    $active = 2;
  		$tabName = "categorias";
  		
  		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'Se agregó la categoría a la inscripción');
		
		return view('inscripcions.informacion_inscripcion', compact('inscripcions','persona','provincias','cantons','categorias','pruebas','ramas','active', 'tabName'));
	}
		/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function storeCategorias(Request $request){
		$cedula = session('cedula_inscripcion');
		
		//colecciones para la vista
		$persona = Persona::showPersona($cedula);
		$provincias = Provincium::obtenerProvincias();	
		$cantons = Canton::obtenerCantones();
		$pruebas =  Prueba::showPruebas();
		$ramas =  Rama::showRamas();
		$fecha_nacimiento = date('Y', strtotime($persona->fecha_nacimiento));
		$categorias = Categoria::showCategoriasDeporteValidaEdad(session('id_deporte'),$fecha_nacimiento );
		$inscripcions = Inscripcion::showPruebasRamaCategoriaInscrita( session('id_deporte'),$persona);
  		
		
		$active = 2;
  		$tabName = "documentos";
		
		return view('inscripcions.informacion_inscripcion', compact('inscripcions','persona','provincias','cantons','categorias','pruebas','ramas','active', 'tabName'));
		
	}
	
	public function subirArchivos(Request $request){
		$cedula = session('cedula_inscripcion');
		
	   // Obtenemos el campo file definido en el formulario
       $pasaporte = $request->file('pasaporte_field');
       $cedula_atras = $request->file('cedula_atras_field');
       $cedula_frente = $request->file('cedula_frente_field');
       $boleta = $request->file('boleta_field');
       $pase_cantonal = $request->file('pase_cantonal_field');
       
       // Guardando las imagenes
       $this->guardarImagen("Pasaporte", $pasaporte);
	   $this->guardarImagen("CedulaAtras", $cedula_atras);
	   $this->guardarImagen("CedulaFrente", $cedula_frente);
	   $this->guardarImagen("BoletaInscripcion", $boleta);
	   $this->guardarImagen("PaseCantonal", $pase_cantonal);
	  
	   //colecciones para la vista
		$persona = Persona::showPersona($cedula);
		$provincias = Provincium::obtenerProvincias();	
		$cantons = Canton::obtenerCantones();
		$pruebas =  Prueba::showPruebas();
		$ramas =  Rama::showRamas();
		$fecha_nacimiento = date('Y', strtotime($persona->fecha_nacimiento));
		$categorias = Categoria::showCategoriasDeporteValidaEdad(session('id_deporte'),$fecha_nacimiento );
		$inscripcions = Inscripcion::showPruebasRamaCategoriaInscrita( session('id_deporte'),$persona);
  		
		
		$active = 2;
  		$tabName = "documentos";
		
		return view('inscripcions.informacion_inscripcion', compact('inscripcions','persona','provincias','cantons','categorias','pruebas','ramas','active', 'tabName'));
		
      
	}	
    
    public function guardarImagen($destination, $file){
    	
    	// Si el archivo viene vacio no hacer nada.
    	//dd($file);
    	if ( 0 != filesize( $file ) )
		{
	    	// file is empty
           $persona = new Persona();
	       $cedula = session('cedula_inscripcion');
	    	
	       $destinationPath = base_path() . '/public/images/' . $destination;
	       $fileName = $cedula . '.jpg';
		   $file->move($destinationPath, $fileName);
		   $ruta =  "images/" . $destination . "/" .$fileName;
		   $persona->$destination($cedula, $ruta);
		}
    	
    	// Verificar si ya existe el archivo enlazado a la persona
    	
    	// En el caso de que este actualizar la ruta con el archivo nuevo
    }
    
    public function finalizarInscripcion(){
    	$cedula = session('cedula_inscripcion');
    	$edicion = Edicion::buscarEdicionActiva();
    	
    	Persona::inscribirPersona($cedula);
    	Inscripcion::insertarInscribes($cedula, $edicion);
    	
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
	public function store(Request $request, User $user){
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
	public function show(Inscripcion $inscripcion){

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
