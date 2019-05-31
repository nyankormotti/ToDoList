@extends('layouts/top')

@section('title','タスク一覧')
@include('common.head')

@include('common.header')

@section('top')
<!-- main -->
<main class="main__task">

    <section class="task__section">

        <!-- sidebar -->
        <section class="sidebar">
            <!-- create form -->
            <div class="create">
                <h2 class="sidebar__title create__title">Create Task</h2>
                <form class="sidebar__form" action="/task__create" method="post">
                    {{ csrf_field() }}
                    @if($errors->has('task_name'))
                    <div class="err__msg--create">{{$errors->first('task_name')}}</div>
                    @endif
                    <div class="sidebar__input">
                        <input class="sidebar__input__area" type="text" name="task_name" autocomplete=off placeholder="15字以内でご記載ください。" value="{{old('task_name')}}">
                    </div>
                    <div class=" sidebar__category">
                        <p class="sidebar__category__title">カテゴリ選択: </p>
                        <select name="category_no" class="sidebar__category__select">
                            @foreach($category_data as $c_data)
                            <option value="{{$c_data->category_no}}">{{$c_data->category_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="create__bottun">
                        <p class="linkcreate">
                            <a class="linkcreate__category" href="myMenu">※カテゴリ変更はこちら</a>
                        </p>
                        <div class="btn__content btn__form create__bottun__btn">
                            <input class="btn" type="submit" value="作成">
                        </div>
                    </div>

                </form>

            </div>

            <!-- search form -->
            <div class="search">
                <h2 class="sidebar__title">Search</h2>
                <form class="sidebar__form" action="/task" method="get">
                    {{ csrf_field() }}
                    <div class="sidebar__input">
                        @if(!empty($search))
                        <input class="sidebar__input__area" type="text" name="search_name" autocomplete=off placeholder="キーワード" value={{$search_name}}>
                        @else
                        <input class="sidebar__input__area" type="text" name="search_name" autocomplete=off placeholder="キーワード">
                        @endif
                    </div>
                    <div class="sidebar__category">
                        <p class="sidebar__category__title">カテゴリ選択: </p>
                        <select name="search_category" class="sidebar__category__select">
                            <option value="0">すべてのカテゴリ</option>
                            @foreach($category_data as $c_data)
                            @if(!empty($search)&& $c_data->category_no == $search_category)
                            <option value="{{$c_data->category_no}}" selected>{{$c_data->category_name}}</option>
                            @else
                            <option value="{{$c_data->category_no}}">{{$c_data->category_name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="search__button">
                        <fieldset class="sort">
                            <legend class="sort__title">並び順</legend>
                            <label class="sort__label">
                                @if(!empty($search)&& $sort == "new"|| empty($search))
                                <input type="radio" name="sort" value="new" checked>
                                @else
                                <input type="radio" name="sort" value="new">
                                @endif
                                作成日の新しい順
                            </label>
                            <br>
                            <label class="sort__label">
                                @if(!empty($search)&& $sort == "old")
                                <input type="radio" name="sort" value="old" checked>
                                @else
                                <input type="radio" name="sort" value="old">
                                @endif
                                作成日の古い順
                            </label>
                        </fieldset>
                        <div class="btn__content btn__form search__button__btn">
                            <input class="btn" type="submit" name="search" value="検索">
                        </div>
                    </div>
                </form>

            </div>

        </section>

        <!-- main contents -->
        <section class="tasklist">
            <div class="task">
                <!-- task title area -->
                <div class="task__titlearea">
                    <h2 class="task__title">Task</h2>
                    <div class="task__titlesub">
                        <p class="task__count">
                            @if(count($task_data) > 0)
                            <span>{{$task_data->firstItem()}}</span> - <span>{{$task_data->lastItem()}}</span><span> / {{$task_data->total()}}</span>
                            @endif

                        </p>
                        <p class="task__link">
                            <a class="tasl__link__text" href="/doneTask">※完了済はこちら</a>
                        </p>
                    </div>
                </div>

                <!-- task list area -->
                <div class="task__listarea">
                    @if(count($task_data) > 0)
                    @foreach($task_data as $t_data)
                    <div class="task__listarea__parts">
                        <div class="task__listarea--show">
                            <div class="parts">
                                @if($t_data->category->category_no == 1 )
                                <div class="parts__color__red"></div>
                                @elseif($t_data->category->category_no == 2 )
                                <div class="parts__color__blue"></div>
                                @elseif($t_data->category->category_no == 3 )
                                <div class="parts__color__orange"></div>
                                @elseif($t_data->category->category_no == 4 )
                                <div class="parts__color__green"></div>
                                @elseif($t_data->category->category_no == 5 )
                                <div class="parts__color__pink"></div>
                                @endif
                                <div class="parts__content">
                                    <div class="parts__content__category">
                                        <span class="parts__content__category__name">
                                            {{$t_data->category->category_name}}
                                        </span>
                                    </div>
                                    <div class="parts__content__todo">
                                        <p class="parts__content__todo__comment">
                                            {{$t_data->task_name}}
                                        </p>
                                    </div>
                                </div>

                            </div>
                            <div class="todo__date">
                                作成:&nbsp;<span>{{$t_data->created_at->format('Y/m/d')}}</span> | <span>更新:&nbsp;{{$t_data->updated_at->format('Y/m/d')}}</span>
                            </div>
                        </div>
                        <div class="task__listarea--action">
                            {{Form::open(['url' => 'task__done', 'files' => true, 'class' => 'btntask__content'])}}
                            <input type="hidden" name="id" value="{{$t_data->id}}">
                            @if(!empty($search))
                            <input type="hidden" name="search_name" value="{{$search_name}}">
                            <input type="hidden" name="search_category" value="{{$search_category}}">
                            <input type="hidden" name="sort" value="{{$sort}}">
                            <input type="hidden" name="search" value="{{$search}}">
                            @endif
                            <input class="btntask__content--action btntask__content--action--finish" type="submit" name="done" value="完了">
                            {{Form::close()}}


                            <div class="btntask__content">
                                @if(!empty($search))
                                <a class="btntask__content--action btntask__content--action--edit" href="editTask?id={{$t_data->id}}&search_name={{$search_name}}&search_category={{$search_category}}&sort={{$sort}}&search={{$search}}">編集</a>
                                @else
                                <a class="btntask__content--action btntask__content--action--edit" href="editTask?id={{$t_data->id}}">編集</a>
                                @endif
                            </div>

                        </div>
                    </div>

                    @endforeach
                    @endif

                </div>

                <!-- pagination -->
                <div class="task__pagination">
                    @if(!empty($search))
                    {{ $task_data->appends(['search_name'=>$search_name,'search_category'=>$search_category,'sort'=>$sort,'search'=>$search])->links('vendor.pagination.original_pagination_view') }}
                    @else
                    {{ $task_data->links('vendor.pagination.original_pagination_view') }}
                    @endif
                </div>

            </div>

        </section>
    </section>

</main>
@endsection

@include('common.footer')