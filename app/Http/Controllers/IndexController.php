<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(Request $request) {
       
            $status = $request->session()->get('status');
            if (Auth::check()) {
                return redirect()->action('TaskController@index');
            }
            return view('index',['status' => $status]);
        
    }
}
