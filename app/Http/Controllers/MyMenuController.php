<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegistCategoryRequest;

class MyMenuController extends Controller
{
    public function index(){

        if (!Auth::check()) {
            return redirect()->action('LoginTaskController@index');
        }

        $id = Auth::id();
        $categoryData = Category::where('user_id', $id)->where('delete_flg', false)->get();
        return view('myMenu',['category_data' => $categoryData]);
    }

    public function registCategory( RegistCategoryRequest $request){

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

        return redirect()->action( 'TaskController@index');
    }
}
