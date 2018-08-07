<?php

namespace Hotel\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Hotel\Http\Controllers\Controller;

class RoomController extends Controller
{
	public function __construct() {

	}

	public function index(){
		return view('rooms.index');
	}


	public function show($slug){
		return view('rooms.show');
	}

	public function reserve($slug){
		return view('rooms.reserve');
	}
}
