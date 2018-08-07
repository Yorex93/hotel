<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace'=>'Api', 'prefix'=>'v1'], function() {
	Route::post( '/login', 'UserController@login');
	Route::post( '/register', 'UserController@register');

	Route::group( ['middleware' => ['auth:api', 'role:admin']], function () {
		Route::post('/logout', 'UserController@logout')->name('logout');

		Route::resource('hotels', 'HotelsController');
//		Route::group(['prefix' => 'hotel'], function(){
//			Route::get('', 'HotelsController@index')->name('admin.hotel.index');
//			Route::post('create', 'HotelsController@store')->name('admin.hotel.create');
//			Route::put('{id}/update', 'HotelsController@update')->name('admin.hotel.update');
//			Route::delete('{id}/delete', 'HotelsController@delete')->name('admin.hotel.delete');
//		});
	});
});
