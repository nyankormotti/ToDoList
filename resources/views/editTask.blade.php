@extends('layouts/top')

@section('title','タスク編集')
@include('common.head')

@include('common.header')

@section('top')
<main class="main">

    <div class="form form--edit">
        <h2 class="form__title">Edit Task</h2>
        <div class="form__content">
            <p class="form__descript form__descript--edit">Taskを編集します。<br>Task内容とカテゴリを編集してください。</p>
            <form action="/editTask" method="post" class="form__block">
                {{ csrf_field() }}
                <input type="hidden" name="t_id" value="{{$t_id}}">
                <div>
                    <label class="textfield__label" for="name">Task内容 (15文字以内)</label>
                </div>
                @if($errors->has('task_name'))
                <div class="err__msg">{{$errors->first('task_name')}}</div>
                @endif
                <div class="textfield__area">
                    @if($errors->has('task_name'))
                    <input type="text" class="textfield__input" name="task_name" value="{{old('task_name')}}" autocomplete="off">
                    @else
                    <input type="text" class="textfield__input" name="task_name" value="{{$task_name}}" autocomplete="off">
                    @endif
                </div>
                <div class="sidebar__category sidebar__category--edit">
                    <p class="sidebar__category__title sidebar__category__title--edit">カテゴリ選択: </p>
                    <select name="category_no" class="sidebar__category__select">
                        @foreach($category_data as $c_data)
                        @if($c_data->category_no == $task_data->category->category_no)
                        <option value="{{$c_data->category_no}}" selected>{{$c_data->category_name}}</option>
                        @else
                        <option value="{{$c_data->category_no}}">{{$c_data->category_name}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>


                <div class="btn__content btn__form btn__edit">
                    <input class="btn" type="submit" name="submit" value="編集">
                </div>

                <p class="link__content">
                    @if(!empty($search))
                    <a class="link" href="task?search_name={{$search_name}}&search_category={{$search_category}}&sort={{$sort}}&search={{$search}}">&gt;&gt;タスク一覧ページ</a>
                    @else
                    <a class="link" href="task">&gt;&gt;タスク一覧ページ</a>
                    @endif
                </p>
            </form>
        </div>
    </div>
</main>

@endsection

@include('common.footer')