<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Task;
use App\Http\Requests\EditTaskRequest;

class EditTaskController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->action('LoginTaskController@index');
        }

        $id = Auth::id();
        $categoryData = Category::where('user_id', $id)->where('delete_flg', false)->get();
        $t_id = $request->id;
        $taskData = Task::where('id', $request->id)->first();
        $task_name = $taskData->task_name;

        // 検索条件がある場合
        if (!empty($request->search)){
            $s_name = $request->search_name;
            $s_category = $request->search_category;
            $s_sort = $request->sort;
            $s_submit = $request->search;
            return view('editTask', ['category_data' => $categoryData, 'task_data' => $taskData])
                ->with('task_name', $task_name)
                ->with('t_id', $t_id)
                ->with('search_name', $s_name)
                ->with('search_category', $s_category)
                ->with('sort', $s_sort)
                ->with('search', $s_submit);
        }else{
            return view('editTask', ['category_data' => $categoryData, 'task_data' => $taskData])
                ->with('task_name', $task_name)
                ->with('t_id', $t_id);
        }
    }

    public function edit(EditTaskRequest $request)
    {
        $task = Task::where('id', $request->t_id)->first();
        $category = Category::where('user_id',Auth::id())->get();
        $task->task_name = $request->task_name;
        foreach($category as $c_data){
            if( $c_data->category_no == $request->category_no){
                $task->category_id = $c_data->id;
            }
        }
        $task->save();

        return redirect()->action('TaskController@index', $request);
    }
}
