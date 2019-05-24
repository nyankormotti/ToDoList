<?php
$flg = false;
?>

@extends('layouts/top')

@section('title','ログイン')
@include('common.head')

@include('common.header')

@section('top')


<!-- main -->
<main class="main main1">

    <div class="form">
        <h2 class="form__title">Login</h2>
        <div class="form__content">
            <p class="form__descript">ログインメールアドレスとパスワードを入力してください。</p>
            @if(count($errors) > 0)
            <p class="err__msg__main">入力値に問題があります。再入力してください。</p>
            @elseif(!empty($message))
            <p class="err__msg__main">{{$message}}</p>
            @endif
            <form action="/loginTask" method="post" class="form__block">
                {{ csrf_field() }}
                <div>
                    <label class="textfield__label" for="Email">メールアドレス</label>
                </div>
                @if($errors->has('email'))
                <div class="err__msg">{{$errors->first('email')}}</div>
                @endif
                <div class="textfield__area">
                    <input type="text" class="textfield__input" name="email" placeholder="メールアドレスを入力してください。" autocomplete="off" value="{{old('email')}}">
                </div>
                <div>
                    <label class="textfield__label" for="Password">パスワード</label>
                </div>
                @if($errors->has('password'))
                <div class="err__msg">{{$errors->first('password')}}</div>
                @endif
                <div class="textfield__area">
                    <input type="password" class="textfield__input" name="password" placeholder="パスワードを入力してください。">
                </div>
                <p class="passSave__content">
                    <label>
                        <input type="checkbox" name="pass_save">
                        ログイン情報を保持する
                    </label>
                </p>
                <div class="btn__content btn__form">
                    <input class="btn" type="submit" name="submit" value="ログイン">
                </div>
                </form>

                <p class="link__content">
                    <a class="link" href="signup">新規会員登録</a>
                </p>
                <p class="link__content">
                    <a class="link" href="passwordRemindSend">パスワードをお忘れの方はこちら</a>
                </p>
        </div>


    </div>

</main>

@endsection

@include('common.footer')