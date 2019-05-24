<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordRemindRecieveController extends Controller
{
    public function index()
    {
        return view('passwordRemindRecieve');
    }
}
