<?php

use App\Http\Middleware\AfterLoginMiddleware;
use App\Http\Middleware\BeforeLoginMiddleware;

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
Route::get('/', 'IndexController@index')->middleware(BeforeLoginMiddleware::class);
Route::get( 'loginTask', 'LoginTaskController@index')->middleware(BeforeLoginMiddleware::class);
Route::post( 'loginTask', 'LoginTaskController@loginTask');
Route::get( 'logoutTask', 'LoginTaskController@logoutTask');
Route::get( 'signup', 'SignUpController@index')->middleware(BeforeLoginMiddleware::class);
Route::post( 'signup', 'SignUpController@create');

Route::get( 'passwordRemindSend', 'PasswordRemindSendContoroller@index')->middleware(BeforeLoginMiddleware::class);
Route::post( 'passwordRemindSend', 'PasswordRemindSendContoroller@store');
Route::get( 'passwordRemindRecieve', 'PasswordRemindRecieveController@index')->middleware(BeforeLoginMiddleware::class);
Route::post( 'passwordRemindRecieve', 'PasswordRemindRecieveController@store');

// ログイン後
Route::get( 'task', 'TaskController@index')->middleware( AfterLoginMiddleware::class);
Route::get( 'task__done', 'TaskController@done')->middleware(AfterLoginMiddleware::class);
Route::post('task__create', 'TaskController@create');
Route::get('doneTask', 'DoneTaskController@index')->middleware(AfterLoginMiddleware::class);
Route::get('doneTask__restore', 'DoneTaskController@restore')->middleware(AfterLoginMiddleware::class);
Route::get('editTask', 'EditTaskController@index')->middleware(AfterLoginMiddleware::class);
Route::post('editTask', 'EditTaskController@edit');
Route::get( 'CompWithdraw', 'CompWithdrawController@index')->middleware(AfterLoginMiddleware::class);

Route::get( 'myMenu', 'MyMenuController@index')->middleware(AfterLoginMiddleware::class);
Route::post( 'myMenu__registCategory', 'MyMenuController@registCategory')->middleware(AfterLoginMiddleware::class);
Route::post( 'myMenu__changeEmail', 'MyMenuController@changeEmail')->middleware(AfterLoginMiddleware::class);
Route::post( 'myMenu__changePassword', 'MyMenuController@changePassword')->middleware(AfterLoginMiddleware::class);
Route::post( 'myMenu__withdraw', 'MyMenuController@withdraw')->middleware(AfterLoginMiddleware::class);

// お問い合わせ
Route::get('contact', 'ContactController@index');
Route::post('contact', 'ContactController@store');
Route::post( 'contact__after', 'ContactController@store__after');

// 例外処理画面
Route::get('error', 'ErrorController@index');


