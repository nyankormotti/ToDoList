<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasswordRemindSendContoroller extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->action('TaskController@index');
        }
        return view('passwordRemindSend');
    }
}
