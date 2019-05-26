<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Task;
use App\Http\Requests\CreateTaskRequest;
use Illuminate\Support\Facades\Input;

class TaskController extends Controller
{

    public function index(Request $request)
    {

        if (!Auth::check()) {
            return redirect()->action('LoginTaskController@index');
        }

        $id = Auth::id();
        $categoryData = Category::where('user_id', $id)->where('delete_flg',false)->get();
        $status = $request->session()->get('status');

        if(!empty($request->search)){
            $query = Task::query();
            // 検索するパラメータを取得
            $s_name = $request->search_name;
            $s_category = $request->search_category;
            $s_sort = $request->sort;
            $s_submit = $request->search;
            

            $query->where('user_id', $id)->where('done_flg',false);

            if (!empty($s_name)) {
                $query->where('task_name', 'like', '%' . $s_name . '%');
            }

            if ($s_category !== '0') {
                $query->whereHas('Category', function ($query) {
                    $query->where('category_no', Input::get('search_category'));
                });
            }

            if ($s_sort === 'new') {
                $query->orderBy('created_at', 'desc');
            } else {
                $query->orderBy('created_at', 'asc');
            }
            $taskData = $query->paginate(5);

            return view('task', ['category_data' => $categoryData, 'task_data' => $taskData,'status' => $status])
                ->with('search_name', $s_name)
                ->with('search_category', $s_category)
                ->with('sort', $s_sort)
                ->with( 'search', $s_submit);
        } else{
            $taskData = Task::where('user_id', $id)->where('done_flg', false)->orderBy('created_at', 'desc')->paginate(5);
            return view('task', ['category_data' => $categoryData, 'task_data' => $taskData, 'status' => $status]);
        }

        
    }

    public function create(CreateTaskRequest $request)
    {
        $category = Category::where('user_id', Auth::id())->where('category_no', $request->category_no)->first();
        $task = new Task;
        $task->task_name = $request->task_name;
        $task->user_id = Auth::id();
        $task->category_id = $category->id;
        $task->save();
        $request->session()->flash('status', 'タスクを作成しました。');

        return redirect()->action('TaskController@index');
    }

    public function done(Request $request){

        $task = Task::where('id', $request->id)->first();
        $task->done_flg = true;
        $task->save();
        $request->session()->flash('status', 'タスクを完了にしました。');

        return redirect()->action('TaskController@index', $request);
    }
}
