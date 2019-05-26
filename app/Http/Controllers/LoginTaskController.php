<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginTaskRequest;
use Illuminate\Support\Facades\Hash;
use App\User;

class LoginTaskController extends Controller
{
    public function index(){

        if (Auth::check()) {
            return redirect()->action('TaskController@index');
        }else{
            return view('loginTask');
        }
       
    }

    public function loginTask(LoginTaskRequest $request){

        $rem = $request->pass_save;

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password,'delete_flg' => false], $rem)) {
            $user = User::where('id', Auth::id())->first();
            $request->session()->flash('status', 'ようこそ  '. $user->name.' さん');
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
