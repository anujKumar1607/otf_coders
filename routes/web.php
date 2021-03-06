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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::namespace('User')->group(function(){
Route::post('/user-register','UserController@store')->name('userResgiseration');
Route::get('user-edit/{id}','UserController@edit')->name('userEdit');	
Route::post('user-update/{id}','UserController@update')->name('userUpdate');	
Route::get('userlist','UserController@userlist')->name('userList')->middleware('auth');	
});


