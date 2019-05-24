<?php
$flg = false;
?>

@extends('layouts/top')

@section('title','トップ')
@include('common.head')

@include('common.header')

@section('top')
<!-- main -->
<main class="main main1">

    <!-- barner -->
    <section class="p-barner">
        <h1 class="p-barner__title">時間という品質を<br>あなたに</h1>
    </section>

    <section class="p-entrance">
        <section class="p-entrance__content">
            <div class="p-entrance__panel">
                <h2 class="p-entrance__panel__title">初めての方はこちら</h2>
                <a href="signup" class="p-entrance__panel__btn signup__btn">Sign Up</a>
            </div>
            <div class="p-entrance__panel">
                <h2 class="p-entrance__panel__title">会員の方はこちら</h2>
                <a href="loginTask" class="p-entrance__panel__btn login__btn">Login</a>
            </div>
        </section>
    </section>
</main>

@endsection

@include('common.footer')