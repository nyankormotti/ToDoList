<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SignUpRequest;
use App\User;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SignUpController extends Controller
{
    public function index()
    {
        return view('signUp');
    }

    public function create(SignUpRequest $request)
    {
        // userテーブル登録処理
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        // ログイン処理
        Auth::login($user);
        $id = Auth::id();

        // categoryテーブル登録処理
        for($no=1; $no<6; $no++){
            $category = new Category;
            $category->category_no = $no;
            $category->category_name = 'サンプル'.$no;
            $category->user_id = $id;
            $category->save();
        }

        return redirect()->action('TaskController@index');
    }
}
