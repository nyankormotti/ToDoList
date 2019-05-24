<?php
$flg = true;
?>

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
                <form class="sidebar__form" action="/task/create" method="post">
                    {{ csrf_field() }}
                    <div class="sidebar__input">
                        <input class="sidebar__input__area" type="text" name="task_name" placeholder="15字以内でご記載ください。">
                    </div>
                    <div class="sidebar__category">
                        <p class="sidebar__category__title">カテゴリ選択: </p>
                        <select name="category_id" class="sidebar__category__select">
                            @foreach($category_data as $c_data)
                            <option value="{{$c_data->category_no}}">{{$c_data->category_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="create__bottun">
                        <p class="linkcreate">
                            <a class="linkcreate__category" href="">※カテゴリ変更はこちら</a>
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
                <form class="sidebar__form" action="post">
                    <div class="sidebar__input">
                        <input class="sidebar__input__area" type="text" name="task" placeholder="キーワード">
                    </div>
                    <div class="sidebar__category">
                        <p class="sidebar__category__title">カテゴリ選択: </p>
                        <select name="category" class="sidebar__category__select">
                            <option value="0">すべてのカテゴリ</option>
                            @foreach($category_data as $c_data)
                            <option value="{{$c_data->category_no}}">{{$c_data->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="search__button">
                        <fieldset class="sort">
                            <legend class="sort__title">並び順</legend>
                            <label class="sort__label">
                                <input type="radio" name="search_sort" value="new" checked>
                                更新日の新しい順
                            </label>
                            <br>
                            <label class="sort__label">
                                <input type="radio" name="search_sort" value="old">
                                更新日の古い順
                            </label>
                        </fieldset>
                        <div class="btn__content btn__form search__button__btn">
                            <input class="btn" type="submit" name="submit" value="検索">
                        </div>
                    </div>

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
                            <span>11</span> - <span>15</span><span> / 20</span>
                        </p>
                        <p class="task__link">
                            <a class="tasl__link__text" href="doneTask.php">※完了済はこちら</a>
                        </p>
                    </div>
                </div>

                <!-- task list area
                <div class="task__listarea">
                    <div class="task__listarea__parts">
                        <div class="task__listarea--show">
                            <div class="parts">
                                <div class="parts__color"></div>
                                <div class="parts__content">
                                    <div class="parts__content__category">
                                        <span class="parts__content__category__name">
                                            サンプル1
                                        </span>
                                    </div>
                                    <div class="parts__content__todo">
                                        <p class="parts__content__todo__comment">
                                            あああああああああああああああ
                                        </p>
                                    </div>
                                </div>

                            </div>
                            <div class="todo__date">
                                作成:<span>2019-05-18</span> / <span>更新:2019-05-18</span>
                            </div>
                        </div>
                        <div class="task__listarea--action">
                            <div class="btntask__content">
                                <a class="btntask__content--action btntask__content--action--finish" href="">完了</a>
                            </div>
                            <div class="btntask__content">
                                <a class="btntask__content--action btntask__content--action--edit" href="editTask.php">編集</a>
                            </div>
                        </div>
                    </div>

                    <div class="task__listarea__parts">
                        <div class="task__listarea--show">
                            <div class="parts">
                                <div class="parts__color__blue"></div>
                                <div class="parts__content">
                                    <div class="parts__content__category">
                                        <span class="parts__content__category__name">
                                            サンプル2
                                        </span>
                                    </div>
                                    <div class="parts__content__todo">
                                        <p class="parts__content__todo__comment">
                                            朝練の準備
                                        </p>
                                    </div>
                                </div>

                            </div>
                            <div class="todo__date">
                                作成:<span>2019-05-18</span> / <span>更新:2019-05-18</span>
                            </div>
                        </div>
                        <div class="task__listarea--action">
                            <div class="btntask__content">
                                <a class="btntask__content--action btntask__content--action--finish" href="">完了</a>
                            </div>
                            <div class="btntask__content">
                                <a class="btntask__content--action btntask__content--action--edit" href="editTask.php">編集</a>
                            </div>
                        </div>
                    </div>

                    <div class="task__listarea__parts">
                        <div class="task__listarea--show">
                            <div class="parts">
                                <div class="parts__color__orange"></div>
                                <div class="parts__content">
                                    <div class="parts__content__category">
                                        <span class="parts__content__category__name">
                                            サンプル3
                                        </span>
                                    </div>
                                    <div class="parts__content__todo">
                                        <p class="parts__content__todo__comment">
                                            ムトさんとラーメン
                                        </p>
                                    </div>
                                </div>

                            </div>
                            <div class="todo__date">
                                作成:<span>2019-05-18</span> / <span>更新:2019-05-18</span>
                            </div>
                        </div>
                        <div class="task__listarea--action">
                            <div class="btntask__content">
                                <a class="btntask__content--action btntask__content--action--finish" href="">完了</a>
                            </div>
                            <div class="btntask__content">
                                <a class="btntask__content--action btntask__content--action--edit" href="editTask.php">編集</a>
                            </div>
                        </div>
                    </div>

                    <div class="task__listarea__parts">
                        <div class="task__listarea--show">
                            <div class="parts">
                                <div class="parts__color__green"></div>
                                <div class="parts__content">
                                    <div class="parts__content__category">
                                        <span class="parts__content__category__name">
                                            サンプル４
                                        </span>
                                    </div>
                                    <div class="parts__content__todo">
                                        <p class="parts__content__todo__comment">
                                            アライグマとデート
                                        </p>
                                    </div>
                                </div>

                            </div>
                            <div class="todo__date">
                                作成:<span>2019-05-18</span> / <span>更新:2019-05-18</span>
                            </div>
                        </div>
                        <div class="task__listarea--action">
                            <div class="btntask__content">
                                <a class="btntask__content--action btntask__content--action--finish" href="">完了</a>
                            </div>
                            <div class="btntask__content">
                                <a class="btntask__content--action btntask__content--action--edit" href="editTask.php">編集</a>
                            </div>
                        </div>
                    </div>

                    <div class="task__listarea__parts">
                        <div class="task__listarea--show">
                            <div class="parts">
                                <div class="parts__color__pink"></div>
                                <div class="parts__content">
                                    <div class="parts__content__category">
                                        <span class="parts__content__category__name">
                                            サンプル1
                                        </span>
                                    </div>
                                    <div class="parts__content__todo">
                                        <p class="parts__content__todo__comment">
                                            キャンプの買い出し
                                        </p>
                                    </div>
                                </div>

                            </div>
                            <div class="todo__date">
                                作成:<span>2019-05-18</span> / <span>更新:2019-05-18</span>
                            </div>
                        </div>
                        <div class="task__listarea--action">
                            <div class="btntask__content">
                                <a class="btntask__content--action btntask__content--action--finish" href="">完了</a>
                            </div>
                            <div class="btntask__content">
                                <a class="btntask__content--action btntask__content--action--edit" href="editTask.php">編集</a>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- pagination -->
                <div class="task__pagination">
                    ページネーション
                </div>

            </div>

        </section>
    </section>

</main>
@endsection

@include('common.footer')