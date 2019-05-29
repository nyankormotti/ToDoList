<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\PassRemindSendMail;
use App\Http\Requests\PassRemindSendRequest;

class PasswordRemindSendContoroller extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->action('TaskController@index');
        }
        return view('passwordRemindSend');
    }

    public function store(PassRemindSendRequest $request)
    {
        
        $toEmail = $request->email;
        $auth_key = '';
        static $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJLKMNOPQRSTUVWXYZ0123456789';
        for ($i = 0; $i < 8; $i++) {
            $auth_key .= $chars[mt_rand(0, 61)];
        }
        Mail::to($toEmail)->send(new PassRemindSendMail($auth_key));

        $request->session()->flash('status', '認証キーを発行しました。');
        $request->session()->put('toEmail', $toEmail);
        session(['auth_key' => $auth_key]);

        return redirect()->action( 'PasswordRemindRecieveController@index', $request);
        
    }
}
