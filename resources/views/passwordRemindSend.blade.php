<?php
$flg = false;
?>

@extends('layouts/top')

@section('title','パスワード再発行')
@include('common.head')

@include('common.header')

@section('top')
<!-- main -->
<main class="main main1">

    <div class="form">
        <h2 class="form__title">Password Remind</h2>
        <div class="form__content">
            <p class="form__descript">ご指定いただいたメールアドレス宛に、<br>
                パスワード再発行用の認証キーを送付します。</p>
            <form action="passwordRemindSend" method="post" class="form__block">
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

                <div class="btn__content btn__form">
                    <input class="btn" type="submit" name="submit" value="送信">
                </div>
            </form>

            <p class="link__content">
                <a class="link" href="/">トップページ</a>
            </p>
        </div>
    </div>
</main>
@endsection

@include('common.footer')