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
            <p class="form__descript">受信されたメールに記載のある認証キーをご記載ください。<br>
                メールにて再発行したパスワードをお伝えします。</p>
            <form action="" method="post" class="form__block">
                <input type="hidden" name="_token">
                <div>
                    <label class="textfield__label" for="Auth_Key">認証キー</label>
                </div>
                <div class="err_msg"></div>
                <div class="textfield__area">
                    <input type="text" class="textfield__input" name="auth_key" placeholder="認証キーを入力してください。" autocomplete="off">
                </div>

                <div class="btn__content btn__form">
                    <input class="btn" type="submit" name="submit" value="送信">
                </div>
            </form>

            <p class="link__content">
                <a class="link" href="passwordRemindSend.php">パスワード再発行メールを再度送付する</a>
            </p>
        </div>
    </div>
</main>

@endsection

@include('common.footer')