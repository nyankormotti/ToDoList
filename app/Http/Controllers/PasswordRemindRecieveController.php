<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Mail\PassRemindRecMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\PassRemindRecRequest;

class PasswordRemindRecieveController extends Controller
{
    public function index(Request $request)
    {
        
        $status = $request->session()->get('status');
        return view('passwordRemindRecieve', ['status' => $status]);
    }

    public function store(PassRemindRecRequest $request)
    {
        
        $toEmail = $request->session()->get('toEmail');
        $auth_key = session()->get('auth_key');
        session()->forget('toEmail');
        session()->forget('auth_key');

        if($auth_key !== $request->auth_key){
            return view('passwordRemindRecieve');
        }
        $password = '';
        static $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJLKMNOPQRSTUVWXYZ0123456789';
        for ($i = 0; $i < 8; $i++) {
            $password .= $chars[mt_rand(0, 61)];
        }
        $user = User::where('email',$toEmail)->where('delete_flg',false)->first();
        $user->password = Hash::make($password);
        $user->save();

        Mail::to($toEmail)->send(new PassRemindRecMail($password));

        $request->session()->flash('status', 'パスワードを再発行しました。');
        $request->session()->put('auth_key', $auth_key);

        return redirect()->action('IndexController@index', $request);
    }
}
