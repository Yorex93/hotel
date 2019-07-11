<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::group(['namespace' => 'Frontend'], function(){
	Route::get('/', 'HomeController@index')->name('home');
	Route::get('/contact', 'HomeController@contact')->name('page.contact');
	Route::post('/contact', 'HomeController@contactSubmit')->name('contact.submit');

	Route::group(['prefix' => 'services'], function(){
		Route::get('', 'ServiceController@index')->name('services.index');
		Route::get('/{slug}', 'ServiceController@show')->name('services.show');
	});

	Route::group(['prefix' => 'hotel-services'], function(){
		Route::get('/{slug}', 'ServiceController@showHotelService')->name('hotel-services.show');
	});

	Route::group(['prefix' => 'gallery'], function(){
		Route::get('', 'MediaController@index')->name('gallery.index');
	});

	Route::group(['prefix' => 'about'], function(){
		Route::get('', 'HomeController@about')->name('page.about');
	});

	Route::group(['prefix' => 'rooms'], function(){
		Route::get('', 'RoomController@index')->name('rooms.index');
		Route::get('/{slug}', 'RoomController@show')->name('rooms.show');
		Route::get('/{slug}/reserve', 'RoomController@reserve')->name('rooms.reserve');
	});

	Route::group(['prefix' => 'reservations'], function(){
		Route::get('', 'ReservationController@index')->name('reservations.index');
		Route::get('/check', 'ReservationController@check')->name('reservations.check');
		Route::post('/make', 'ReservationController@make')->name('reservations.make');
	});

	Route::group(['prefix' => 'facilities'], function(){
		Route::get('', 'FacilityController@index')->name('facilities.index');
		Route::get('/{slug}', 'FacilityController@show')->name('facilities.show');
	});

});



Route::get('/admin/{any?}', function () {
	return view('admin.index');
})->where('any', '[\/\w\.-]*');
