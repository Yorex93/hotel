<?php

namespace Hotel\Http\Controllers\Frontend;

use Hotel\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{

	public function __construct() {

	}

	public function index(){
		return view('pages.home');
	}


	public function contact(){
		return view('pages.contact');
	}

	public function about(){
		return view('pages.contact');
	}
}
