<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordRemindSendContoroller extends Controller
{
    public function index()
    {
        return view('passwordRemindSend');
    }
}
