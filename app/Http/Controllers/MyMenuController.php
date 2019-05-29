<?php

namespace App\Http\Controllers;


use App\User;
use App\Category;
use App\Mail\ChangePassMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ChangeEmailRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\RegistCategoryRequest;

class MyMenuController extends Controller
{
    public function index(){

        
            if (!Auth::check()) {
                return redirect()->action('LoginTaskController@index');
            }
            $id = Auth::id();
            $userData = User::where('id', $id)->first();
            $categoryData = Category::where('user_id', $id)->where('delete_flg', false)->get();
            return view('myMenu', ['user_data' => $userData, 'category_data' => $categoryData,]);
        
    }

    public function registCategory(RegistCategoryRequest $request){

        $id = Auth::id();
        $category1 = Category::where('user_id', $id)->where('category_no', 1)->where('delete_flg', false)->first();
        $category2 = Category::where('user_id', $id)->where('category_no', 2)->where('delete_flg', false)->first();
        $category3 = Category::where('user_id', $id)->where('category_no', 3)->where('delete_flg', false)->first();
        $category4 = Category::where('user_id', $id)->where('category_no', 4)->where('delete_flg', false)->first();
        $category5 = Category::where('user_id', $id)->where('category_no', 5)->where('delete_flg', false)-> first();

        $category1->category_name = $request->category1;
        $category2->category_name = $request->category2;
        $category3->category_name = $request->category3;
        $category4->category_name = $request->category4;
        $category5->category_name = $request->category5;

        $category1->save();
        $category2->save();
        $category3->save();
        $category4->save();
        $category5->save();

        $request->session()->flash('status', 'カテゴリーを編集しました。');

        return redirect()->action( 'TaskController@index', $request);
    }

    public function changeEmail(ChangeEmailRequest $request){
        $id = Auth::id();
        $user = User::where('id',$id)->first();
        $user->email =$request->email;
        $user->save();
        $request->session()->flash('status', 'メールアドレスを変更しました。');
        return redirect()->action('TaskController@index');
    }

    public function changePassword(ChangePasswordRequest $request){

        $id = Auth::id();
        $user = User::where('id', $id)->first( );
        $user->password = Hash::make($request->password);
        $user->save();

        Mail::to($user->email)->send(new ChangePassMail($user->name, $request->password));

        $request->session()->flash('status', 'パスワードを変更しました。');
        return redirect()->action('TaskController@index');
    }

    public function  withdraw(Request $request){
        $id = Auth::id();
        $user = User::where('id', $id)->first();
        $user->delete_flg = true;
        $user->save();
        return redirect()->action( 'CompWithdrawController@index', $request);
    }

}
