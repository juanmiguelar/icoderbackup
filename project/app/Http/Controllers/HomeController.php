<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Deporte;
use \Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
     
    public function index()
    {
        $deportes = Deporte::orderBy('id_deporte', 'desc')->paginate(10);
        // $user = \DB::select("call user(1)");
		return view('deporte_home', compact('deportes','user'));
    }
}
