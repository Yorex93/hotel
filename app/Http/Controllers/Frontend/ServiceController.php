<?php

namespace Hotel\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Hotel\Http\Controllers\Controller;

class ServiceController extends Controller
{
	public function __construct() {

	}

	public function index(){
		return view('services.index');
	}


	public function show($slug){
		return view('services.show');
	}
}
