<?php

namespace Hotel\Http\Controllers\Api;

use Auth;
use Hotel\User;
use Hotel\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    public function login(Request $request){

	    if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
		    $user = Auth::user();
		    $success['token'] =  $user->createToken('Hotel')->accessToken;
		    $success['user'] = $user;
		    $success['permissions'] = $user->getAllPermissions();
		    return response()->json(['success' => $success], 200);
	    }
	    else{
		    return response()->json(['error'=>'Unauthorised'], 401);
	    }
    }


	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function register(Request $request){
	    $validator = Validator::make($request->all(), [
		    'name' => 'required',
		    'email' => 'required|email',
		    'password' => 'required',
		    'password_confirm' => 'required|same:password',
	    ]);
	    if ($validator->fails()) {
		    return response()->json(['error'=>$validator->errors()], 401);
	    }
	    $input = $request->only('name', 'email', 'password');
	    $input['password'] = bcrypt($input['password']);
	    $user = User::create($input);
		$user->assignRole('admin');

	    $success['token'] =  $user->createToken('Hotel')->accessToken;
	    $success['name'] =  $user->name;
	    return response()->json(['success'=>$success], 200);
    }


    public function logout(){
		if(Auth::check()){
			$accessToken = Auth::user()->token();
			$accessToken->revoke();
		}
	    return response()->json(null, 204);
    }
}
