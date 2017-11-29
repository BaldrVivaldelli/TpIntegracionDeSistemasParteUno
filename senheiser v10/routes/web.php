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
//Ruta personal
Route::get('/personal','PersonalController@index')->name('personal');


Route::get('/account','AccountController@index')->name('account');

//Ruta para el login
Route::get('/login',function() {
		return view('login', compact (Auth::routes));
	});

//Ruta para el detalle
Route::get('/productDetail',function() {
		return view('productDetail', compact(Auth::routes));
});


//Rutas para la seguna parte de la materia 
Route::get('/getAllFileName','ProductController@getAllFileName');
Route::get('/getAll','ProductController@getAll');
Route::get('/getFileById/{id}','ProductController@getFileById');
Route::get('/getFileByTagName//','ProductController@getFileByTagName');


//Rutas para la primera parte de la materia
Route::get('/logout','LogOutController@logOut')->middleware('auth');
Route::delete('/deleteFile/{id}','FileController@destroy')->middleware('auth');
Route::get('/download/{id}','FileController@show')->middleware('auth');
Route::post('/uploadFile','FileController@create')->middleware('auth');

Route::get('/detailsFile/{hashName}','FileController@detail')->middleware('auth');


Route::get("/files?name={id}",'FileController@show');


Route::put('/file/{id}','FileController@edit')->middleware('auth');
Auth::routes();

