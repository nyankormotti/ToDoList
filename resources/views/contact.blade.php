@extends('layouts/top')

@section('title','お問い合わせ')
@include('common.head')

@include('common.header')

@section('top')
<!-- main -->
<main class="main main1">

    <div class="form form__beforelogin">
        <h2 class="form__title">Contact</h2>
        <div class="form__content">
            <p class="form__descript">メールアドレスと内容をご記載の上、お問い合わせください。</p>
            @if (!Auth::check())
            <form action="contact" method="post" class="form__block">
                @else
                <form action="contact__after" method="post" class="form__block">
                    @endif
                    {{ csrf_field() }}
                    @if (!Auth::check())
                    <div>
                        <label class="textfield__label" for="Email">メールアドレス(必須)</label>
                    </div>
                    @if($errors->has('email'))
                    <div class="err__msg">{{$errors->first('email')}}</div>
                    @endif
                    <div class="textfield__area">
                        <input type="text" class="textfield__input" name="email" placeholder="メールアドレスを入力してください。" autocomplete="off" value="{{old('email')}}">
                    </div>
                    @endif
                    <div>
                        <label class="textfield__label" for="Comment">お問い合わせ内容 (500文字以内)</label>
                    </div>
                    @if($errors->has('comment'))
                    <div class="err__msg">{{$errors->first('comment')}}</div>
                    @endif
                    <div class="js-err_comment"></div>
                    <div class="textfield__comment__area">
                        <textarea class="textfield__comment js-comment-input" name="comment" id="" cols="30" rows="10" placeholder="お問い合わせ内容を入力してください。" value="{{old('comment')}}"></textarea>
                    </div>
                    <div class="comment__content js-comment-content">
                        <span class="js-comment--count">0</span><span> / 500</span>
                    </div>

                    <div class="btn__content btn__form">
                        <input class="btn" type="submit" name="submit" value="送信">
                    </div>
                </form>
        </div>
    </div>

</main>

@endsection

@include('common.footer')