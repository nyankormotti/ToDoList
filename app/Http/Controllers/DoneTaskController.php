<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Task;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\DoneTaskRequest;

class DoneTaskController extends Controller
{
    public function index(DoneTaskRequest $request)
    {

        $id = Auth::id();
        $categoryData = Category::where('user_id', $id)->where('delete_flg', false)->get();
        $status = $request->session()->get('status');

        $s_name = '';
        $s_category = '';
        $s_strat_date = '';
        $s_end_date = '';
        $s_sort = '';
        $s_submit = '';

        // セッションの値を格納
        if (!empty(session()->get('search'))) {
            $s_name = session()->get('search_name');
            $s_category = session()->get('search_category');
            $s_strat_date = session()->get( 'strat_date');
            $s_end_date = session()->get( 'end_date');
            $s_sort = session()->get('sort');
            $s_submit = session()->get('search');

            // リクエストの値を格納
        } elseif (!empty($request->search)) {
            $s_name = $request->search_name;
            $s_category = $request->search_category;
            $s_strat_date = $request->strat_date;
            $s_end_date = $request->end_date;
            $s_sort = $request->sort;
            $s_submit = $request->search;
        }

        if (!empty(session()->get('search')) || !empty($request->search)) {
            $query = Task::query();

            $query->where('user_id', $id)->where('done_flg', true);

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
            } elseif (!empty($request->search)) {

                if ($s_category !== '0') {
                    $query->whereHas('Category', function ($query) {
                        $query->where('category_no', Input::get('search_category'));
                    });
                }
            }

            // 検索開始年月日をORMの条件に指定
            if(!empty($s_strat_date)){
                $query-> whereDate( 'updated_at','>=',$s_strat_date);
            }

            // 検索終了年月日をORMの条件に指定
            if(!empty($s_end_date)){
                $query->whereDate('updated_at', '<=', $s_end_date);
            }

            // ソート順を指定
            if ($s_sort === 'new') {
                $query->orderBy('updated_at', 'desc');
            } else {
                $query->orderBy( 'updated_at', 'asc');
            }

             // ORM実行(DBからデータ取得)
            $taskData = $query->paginate(5);

            // セッションがある場合、セッションを破棄
            if (!empty(session()->get('search'))){
                session()->forget('search_name');
                session()->forget('search_category');
                session()->forget( 'strat_date');
                session()->forget( 'end_date');
                session()->forget('sort');
                session()->forget('search');
            }

            return view( 'doneTask', ['category_data' => $categoryData, 'task_data' => $taskData, 'status' => $status])
                ->with('search_name', $s_name)
                ->with('search_category', $s_category)
                ->with( 'strat_date', $s_strat_date)
                ->with( 'end_date', $s_end_date)
                ->with('sort', $s_sort)
                ->with('search', $s_submit);
        } else {
            $taskData = Task::where('user_id', $id)->where('done_flg', true)->orderBy( 'updated_at', 'desc')->paginate(5);
            return view('doneTask', ['category_data' => $categoryData, 'task_data' => $taskData, 'status' => $status]);
        }
    }

    public function restore(Request $request)
    {

        $task = Task::where('id', $request->id)->first();
        $task->done_flg = false;
        $task->save();
        $request->session()->flash('status', 'タスクを復元しました。');

        session(['search_name' => $request->search_name]);
        session(['search_category' => $request->search_category]);
        session([ 'strat_date' => $request->strat_date]);
        session([ 'end_date' => $request->end_date]);
        session(['sort' => $request->sort]);
        session(['search' => $request->search]);

        return redirect()->action('DoneTaskController@index');
    }
}
