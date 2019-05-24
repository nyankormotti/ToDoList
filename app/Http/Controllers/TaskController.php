<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Task;

class TaskController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $categoryData = Category::where('user_id', $id)->get();
        return view('task', ['category_data'=> $categoryData]);
    }

    public function create(Request $request)
    {
        $task = new Task;
        $task->task_name = $request->task_name;
        $task->user_id = Auth::id();
        $task->category_id = $request->category_id;
        $task->save();

        return redirect()->action('TaskController@index');
    }
}
