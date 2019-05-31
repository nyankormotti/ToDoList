@extends('layouts/top')

@section('title','サンプル')
@include('common.head')

@include('common.header')

@section('top')
<main class="main__task">
    <section class="task__section">
        <section class="tasklist">
            <div class="task">
                <div class="task__listarea">
                    <div class="task__listarea__parts">
                        <div class="task__listarea--show">
                            <div class="parts">
                                <div class="task__listarea--action">
                                    {{Form::open(['url' => 'task__done', 'files' => true, 'class' => 'btntask__content'])}}

                                    <input type="hidden" name="id" value="">
                                    <input class="btntask__content--action btntask__content--action--finish" type="submit" name="done" value="完了">
                                    {{Form::close()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

</main>

@endsection

@include('common.footer')