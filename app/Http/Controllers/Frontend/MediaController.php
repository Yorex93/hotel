<?php

namespace Hotel\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Hotel\Http\Controllers\Controller;

class MediaController extends Controller
{
	public function __construct() {

	}

	public function index(){
		return view('media.index');
	}

}
