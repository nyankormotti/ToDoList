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

// ログイン前
Route::get('/', 'IndexController@index');
Route::get( 'loginTask', 'LoginTaskController@index');
Route::post( 'loginTask', 'LoginTaskController@loginTask');
Route::get( 'logoutTask', 'LoginTaskController@logoutTask');
Route::get( 'signup', 'SignUpController@index');
Route::post( 'signup', 'SignUpController@create');

Route::get( 'passwordRemindSend', 'PasswordRemindSendContoroller@index');
Route::post( 'passwordRemindSend', 'PasswordRemindSendContoroller@store');
Route::get( 'passwordRemindRecieve', 'PasswordRemindRecieveController@index');
Route::post( 'passwordRemindRecieve', 'PasswordRemindRecieveController@store');

// ログイン後
Route::get( 'task', 'TaskController@index');
Route::get( 'task__done', 'TaskController@done');
Route::post('task__create', 'TaskController@create');
Route::get('doneTask', 'DoneTaskController@index');
Route::get('doneTask__restore', 'DoneTaskController@restore');
Route::get('editTask', 'EditTaskController@index');
Route::post('editTask', 'EditTaskController@edit');
Route::get( 'CompWithdraw', 'CompWithdrawController@index');

Route::get( 'myMenu', 'MyMenuController@index');
Route::post( 'myMenu__registCategory', 'MyMenuController@registCategory');
Route::post( 'myMenu__changeEmail', 'MyMenuController@changeEmail');
Route::post( 'myMenu__changePassword', 'MyMenuController@changePassword');
Route::post( 'myMenu__withdraw', 'MyMenuController@withdraw');

// お問い合わせ
Route::get('contact', 'ContactController@index');
Route::post('contact', 'ContactController@store');

// 例外処理画面
Route::get('error', 'ErrorController@index');


