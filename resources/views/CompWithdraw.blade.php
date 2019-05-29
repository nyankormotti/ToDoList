@extends('layouts/top')

@section('title','退会完了')
@include('common.head')

@include('common.header')

@section('top')
<main class="main">

    <div class="form form--withdraw">
        <h2 class="form__title">退会完了</h2>
        <div class="form__content">
            <p class="form__descript form__descript--withdraw">退会処理が完了しました。</p>

            <p class="link__content">
                <a class="link" href="signup">&gt;&gt;会員登録ページ</a>
            </p>
            </form>
        </div>
    </div>
</main>

@endsection

@include('common.footer')