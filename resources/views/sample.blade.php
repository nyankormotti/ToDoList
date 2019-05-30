@extends('layouts/top')

@section('title','サンプル')
@include('common.head')

@include('common.header')

@section('top')
<main class="main__task">
    @for($i = 0; $i < 5; $i++) <div style="border:5px solid white; width:80%;height:100px; magirn:10px auto; ">
        <form action="" style="border:5px solid red; width:80%;height:40px; magirn:10px auto; ">
            <input type="text">
        </form>
        </div>
        @endfor
</main>

@endsection

@include('common.footer')