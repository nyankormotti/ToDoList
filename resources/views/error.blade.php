@extends('layouts/top')

@section('title','エラー')
@include('common.head')

@include('common.header')

@section('top')

<body class="wrap wrap__top">
    <main class="main">
        <div class="form form--withdraw">
            <h2 class="form__title">Error</h2>
            <div class="form__content">
                <p class="form__descript form__descript--withdraw">エラーが発生しました。<br>しばらく待ってからやり直してください。</p>

                <p class="link__content">
                    <a class="link" href="/">&gt;&gt;トップページ</a>
                </p>
                </form>
            </div>
        </div>
    </main>
    @endsection

    @include('common.footer')