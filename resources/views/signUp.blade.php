<?php
$flg = false;
?>

@extends('layouts/top')

@section('title','会員登録')
@include('common.head')

@include('common.header')

@section('top')


<!-- main -->
<main class="main main1">

    <div class="form">
        <h2 class="form__title">Sign Up</h2>
        <div class="form__content">
            <p class="form__descript">会員登録に利用するログインメールアドレスを記載してください。</p>
            @if(count($errors) > 0)
            <p class="err__msg__main">入力値に問題があります。再入力してください。</p>
            @endif
            <form action="/signup" method="post" class="form__block">
                {{ csrf_field() }}
                <!-- <input type="hidden" name="_token"> -->
                <div>
                    <label class="textfield__label" for="name">アカウント名(必須)</label>
                </div>
                @if($errors->has('name'))
                <div class="err__msg">{{$errors->first('name')}}</div>
                @endif
                <div class="textfield__area">
                    <input type="text" class="textfield__input" name="name" placeholder="アカウント名を入力してください。" autocomplete="off" value="{{old('name')}}">
                </div>
                <div>
                    <label class="textfield__label" for="Email">メールアドレス(必須)</label>
                </div>
                @if($errors->has('email'))
                <div class="err__msg">{{$errors->first('email')}}</div>
                @endif
                <div class="textfield__area">
                    <input type="text" class="textfield__input" name="email" placeholder="メールアドレスを入力してください。" autocomplete="off" value="{{old('email')}}">
                </div>
                <div>
                    <label class=" textfield__label" for="Password">パスワード(必須)&nbsp;&nbsp;※半角英数字8桁</label>
                </div>
                @if($errors->has('password'))
                <div class="err__msg">{{$errors->first('password')}}</div>
                @endif
                <div class="textfield__area">
                    <input type="password" class="textfield__input" name="password" placeholder="パスワードを入力してください。" value="{{old('password')}}">
                </div>
                <div>
                    <label class=" textfield__label" for="Password">パスワード(確認)</label>
                </div>
                @if($errors->has('password_re'))
                <div class="err__msg">{{$errors->first('password_confirmation')}}</div>
                @endif
                <div class="textfield__area">
                    <input type="password" class="textfield__input" name="password_confirmation" placeholder="パスワードを入力してください。" value="{{old('password_re')}}">
                </div>

                <div class="btn__content btn__form">
                    <input class="btn" type="submit" name="submit" value="登録">
                </div>
            </form>
        </div>
    </div>

</main>

@endsection

@include('common.footer')