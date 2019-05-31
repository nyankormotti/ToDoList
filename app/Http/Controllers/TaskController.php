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
        $id = Auth::id();
        $categoryData = Category::where('user_id', $id)->where('delete_flg',false)->get();
        $status = $request->session()->get('status');

        $s_name='';
        $s_category='';
        $s_sort ='';
        $s_submit='';

        // セッションの値を格納
        if(!empty(session()->get('search'))){
            $s_name = session()->get('search_name');
            $s_category = session()->get( 'search_category');
            $s_sort = session()->get( 'sort');
            $s_submit = session()->get('search');

            // リクエストの値を格納
        } elseif (!empty($request->search)){
            $s_name = $request->search_name;
            $s_category = $request->search_category;
            $s_sort = $request->sort;
            $s_submit = $request->search;
        }

        // 検索条件がある場合
        if(!empty( session()->get('search')) ||!empty($request->search)){
            $query = Task::query();
            $query->where('user_id', $id)->where('done_flg',false);

            // 検索キーワードをORMの条件に指定
            if (!empty($s_name)) {
                $query->where('task_name', 'like', '%' . $s_name . '%');
            }

            // 検索カテゴリーをORMの条件に指定
            if (!empty(session()->get('search'))) {
                if ($s_category !== '0') {
                    $query->whereHas('Category', function ($query) {
                        $query->where('category_no', session()->get('search_category'));
                    });
                }
            } elseif (!empty($request->search)){
                
                if ($s_category !== '0') {
                    $query->whereHas('Category', function ($query) {
                        $query->where('category_no', Input::get('search_category'));
                    });
                }
            }
            
            // ソート順を指定
            if ($s_sort === 'new') {
                $query->orderBy('created_at', 'desc');
            } else {
                $query->orderBy('created_at', 'asc');
            }

            // ORM実行(DBからデータ取得)
            $taskData = $query->paginate(5);

            // セッションがある場合、セッションを破棄
            if (!empty(session()->get('search'))){
                session()->forget('search_name');
                session()->forget('search_category');
                session()->forget('sort');
                session()->forget('search');
            }

            return view('task', ['category_data' => $categoryData, 'task_data' => $taskData,'status' => $status])
                ->with('search_name', $s_name)
                ->with('search_category', $s_category)
                ->with( 'sort', $s_sort)
                ->with( 'search', $s_submit);

        // 検索条件がない場合
        } else {
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

        session([ 'search_name' => $request->search_name]);
        session([ 'search_category' => $request->search_category]);
        session([ 'sort' => $request->sort]);
        session([ 'search' => $request->search]);

        return redirect()->action('TaskController@index');
    }
}
