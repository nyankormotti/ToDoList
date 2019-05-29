@extends('layouts/top')

@section('title','完了タスク一覧')
@include('common.head')

@include('common.header')

@section('top')
<!-- main -->
<main class="main__task">

    <section class="task__section">

        <!-- sidebar -->
        <section class="sidebar">

            <!-- search form -->
            <div class="search search--done">
                <h2 class="sidebar__title">Search</h2>
                <form class="sidebar__form" action="/doneTask" method="get">
                    <div class="sidebar__input">
                        @if(!empty($search))
                        <input class="sidebar__input__area" type="text" name="search_name" autocomplete=off placeholder="キーワード" value="{{$search_name}}">
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

                    <div class="sidebar__date">
                        <p class="sidebar__date__title">期間 (完了年月日)</p>
                        @if($errors->has('strat_date'))
                        <div class="err__msg--create">{{$errors->first('strat_date')}}</div>
                        @elseif($errors->has('end_date'))
                        <div class="err__msg--create">{{$errors->first('end_date')}}</div>
                        @endif
                        <div class="sidebar__date__input">
                            <div class="sidebar__date__input__area">

                                @if(!empty($search)&&$errors->has('strat_date')||$errors->has('end_date'))
                                <input class="sidebar__date__input__area--write datepicker" type="text" name="strat_date" autocomplete=off placeholder="開始年月日" value="{{old('strat_date')}}">
                                @elseif(!empty($search))
                                <input class="sidebar__date__input__area--write datepicker" type="text" name="strat_date" autocomplete=off placeholder="開始年月日" value="{{$strat_date}}">
                                @else
                                <input class="sidebar__date__input__area--write datepicker" type="text" name="strat_date" autocomplete=off placeholder="開始年月日">
                                @endif
                            </div>

                            <p class="sidebar__date__input__between">〜</p>
                            <div class="sidebar__date__input__area">

                                @if(!empty($search)&&$errors->has('end_date')||$errors->has('end_date'))
                                <input class="sidebar__date__input__area--write datepicker" type="text" name="end_date" autocomplete=off placeholder="終了年月日" value="{{old('end_date')}}">
                                @elseif(!empty($search))
                                <input class="sidebar__date__input__area--write datepicker" type="text" name="end_date" autocomplete=off placeholder="終了年月日" value="{{$end_date}}">
                                @else
                                <input class="sidebar__date__input__area--write datepicker" type="text" name="end_date" autocomplete=off placeholder="終了年月日">
                                @endif
                            </div>

                        </div>
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
                                完了日の新しい順
                            </label>
                            <br>
                            <label class="sort__label">
                                @if(!empty($search)&& $sort == "old")
                                <input type="radio" name="sort" value="old" checked>
                                @else
                                <input type="radio" name="sort" value="old">
                                @endif
                                完了日の古い順
                            </label>
                        </fieldset>
                        <div class="btn__content btn__form search__button__btn">
                            <input class="btn" type="submit" name="search" value="検索">
                        </div>
                    </div>

            </div>

        </section>

        <!-- main contents -->
        <section class="tasklist">
            <div class="task">
                <!-- task title area -->
                <div class="task__titlearea">
                    <h2 class="task__title task__title--done">Done Task</h2>
                    <div class="task__titlesub">
                        <p class="task__count">
                            @if(count($task_data) > 0)
                            <span>{{$task_data->firstItem()}}</span> - <span>{{$task_data->lastItem()}}</span><span> / {{$task_data->total()}}</span>
                            @endif
                        </p>
                    </div>
                </div>
                @if(count($errors) > 0)
                <div class="err__done">検索条件が間違っています。</div>
                @endif

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
                                完了:&nbsp;<span>{{$t_data->updated_at->format('Y/m/d')}}</span>
                            </div>
                        </div>
                        <div class="task__listarea--action">
                            <div class="btntask__content">
                                @if(!empty($search))
                                <a class="btntask__content--action btntask__content--action--restore" href="doneTask__restore?id={{$t_data->id}}&search_name={{$search_name}}&search_category={{$search_category}}&strat_date={{$strat_date}}&end_date={{$end_date}}&sort={{$sort}}&search={{$search}}">復元</a>
                                @else
                                <a class="btntask__content--action btntask__content--action--restore" href="doneTask__restore?id={{$t_data->id}}">復元</a>
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
                    {{ $task_data->appends(['search_name'=>$search_name,'search_category'=>$search_category,'strat_date'=>$strat_date,'end_date'=>$end_date,'sort'=>$sort,'search'=>$search])->links('vendor.pagination.original_pagination_view') }}
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