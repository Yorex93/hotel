<?php

namespace Hotel\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Hotel\Http\Controllers\Controller;

class FacilityController extends Controller
{
	public function __construct() {

	}

	public function index(){
		return view('facilities.index');
	}


	public function show($slug){
		return view('facilities.show');
	}
}
