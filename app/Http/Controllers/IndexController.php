<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request) {
            $status = $request->session()->get('status');
            return view('index',['status' => $status]);
    }
}
