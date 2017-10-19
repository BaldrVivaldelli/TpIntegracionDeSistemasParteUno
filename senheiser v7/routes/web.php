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

Route::get('/', function () {
    return view('Home');
});
//Ruta al home
Route::get('/home', 'HomeController@index')->name('home');

//Ruta a test
Route::get('/test','ProductController@add');


//Ruta para el login
Route::get('/login',function() {
		return view('login', compact (Auth::routes));
	});

//Ruta de prueba 
Route::get('/probandoUnRouting','ProductController@getAll');
Route::get('/logout','LogOutController@logOut')->middleware('auth');
Route::delete('/deleteFile/{id}','FileController@destroy')->middleware('auth');
Route::get('/download/{id}','FileController@show')->middleware('auth');
Route::post('/uploadFile','FileController@create')->middleware('auth');

Route::put('/file/{id}','FileController@edit')->middleware('auth');
Auth::routes();

