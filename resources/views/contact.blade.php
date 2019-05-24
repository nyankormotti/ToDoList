<?php
$flg = false;
?>

@extends('layouts/top')

@section('title','お問い合わせ')
@include('common.head')

@include('common.header')

@section('top')
<!-- main -->
<main class="main main1">

    <div class="form">
        <h2 class="form__title">Contact</h2>
        <div class="form__content">
            <p class="form__descript">メールアドレスと内容をご記載の上、お問い合わせください。</p>
            <form action="" method="post" class="form__block">
                <input type="hidden" name="_token">
                <div>
                    <label class="textfield__label" for="Email">メールアドレス(必須)</label>
                </div>
                <div class="err_msg"></div>
                <div class="textfield__area">
                    <input type="text" class="textfield__input" name="email" placeholder="メールアドレスを入力してください。" autocomplete="off">
                </div>
                <div>
                    <label class="textfield__label" for="Comment">お問い合わせ内容 (500文字以内)</label>
                </div>
                <div class="js-err_comment"></div>
                <div class="textfield__comment__area">
                    <textarea class="textfield__comment js-comment-input" name="comment" id="" cols="30" rows="10" placeholder="お問い合わせ内容を入力してください。"></textarea>
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