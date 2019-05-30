<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\ContactAfterRequest;

class ContactController extends Controller
{
    public function index()
    {

        return view('contact');
    }

    public function store(ContactRequest $request){
        
            $fromEmail = $request->email;
            $comment = $request->comment;

            Mail::to('info@info.com')->send(new ContactMail($fromEmail, $comment));

            $request->session()->flash('status', 'お問い合わせメールを送信しました。');

            return redirect()->action('IndexController@index', $request);
        
    }

    public function store__after( ContactAfterRequest $request)
    {

        $user = User::where('id', Auth::id())->first();
        $fromEmail = $user->email;

        $comment = $request->comment;

        Mail::to('info@info.com')->send(new ContactMail($fromEmail, $comment));

        $request->session()->flash('status', 'お問い合わせメールを送信しました。');

        return redirect()->action('TaskController@index', $request);

    }
}
