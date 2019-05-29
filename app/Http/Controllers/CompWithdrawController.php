<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class CompWithdrawController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->action('LoginTaskController@index');
        }
        $id = Auth::id();
        $user = User::where('id', $id)->first();
        if($user->delete_flg){
            Auth::logout();
            return view('CompWithdraw');
        } else{
            return redirect()->action('TaskController@index', $request);
        }
    }
}
