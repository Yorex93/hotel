<?php

namespace Hotel\Http\Controllers\Frontend;

use Hotel\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
	public function __construct() {

	}

	public function index(){
		return view('reservations.index');
	}


	public function check(Request $request){
		return view('reservations.check');
	}

}
