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

Route::get('/', 'IndexController@index');
Route::get( 'loginTask', 'LoginTaskController@index');
Route::post( 'loginTask', 'LoginTaskController@loginTask');
Route::get( 'logoutTask', 'LoginTaskController@logoutTask');
Route::get( 'signup', 'SignUpController@index');
Route::post( 'signup', 'SignUpController@create');
Route::get( 'contact', 'ContactController@index');
Route::get( 'passwordRemindSend', 'PasswordRemindSendContoroller@index');
Route::get( 'passwordRemindRecieve', 'PasswordRemindRecieveController@index');
Route::get( 'task', 'TaskController@index');
Route::post( 'task', 'TaskController@index');
Route::post('task/create', 'TaskController@create');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
