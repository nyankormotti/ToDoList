<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginTaskRequest;
use Illuminate\Support\Facades\Hash;

class LoginTaskController extends Controller
{
    public function index(){
        return view( 'loginTask');
    }

    public function loginTask(LoginTaskRequest $request){

        $rem = $request->pass_save;

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $rem)) {
            // return view('task');
            return redirect()->action('TaskController@index');
        } else {
            $msg = 'メールアドレスまたはパスワードが違います。';
            return view('loginTask', ['message' => $msg]);
        }
    }

    public function logoutTask(){
        Auth::logout();
        return view( 'loginTask');
    }
}
