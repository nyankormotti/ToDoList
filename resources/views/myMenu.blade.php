@extends('layouts/top')

@section('title','マイメニュー')
@include('common.head')

@include('common.header')

@section('top')

<!-- main -->
<main class="main">

    <div class="myMenu">
        <h1 class="myMenu__maintitle">My Menu</h1>
        <!-- カテゴリー編集 -->
        <section class="myMenu__parts myMenu__cate toggle_wrap">
            @if($errors->has('category1')||$errors->has('category2')||$errors->has('category3')||$errors->has('category4')||$errors->has('category5'))
            <div class="myMenu__title toggle_switch open">
                @else
                <div class="myMenu__title toggle_switch">
                    @endif
                    <p>カテゴリー編集</p>
                </div>
                @if($errors->has('category1')||$errors->has('category2')||$errors->has('category3')||$errors->has('category4')||$errors->has('category5'))
                <form class="form__content toggle_contents" action="myMenu/registCategory" method="post" style="display:block;">
                    @else
                    <form class="form__content toggle_contents" action="myMenu/registCategory" method="post">
                        @endif
                        {{ csrf_field() }}
                        <p class="form__descript">5つのカテゴリ名を編集できます。</p>
                        @if($errors->has('category1'))
                        <div class="err__msg">{{$errors->first('category1')}}</div>
                        @elseif($errors->has('category2'))
                        <div class="err__msg">{{$errors->first('category2')}}</div>
                        @elseif($errors->has('category3'))
                        <div class="err__msg">{{$errors->first('category3')}}</div>
                        @elseif($errors->has('category4'))
                        <div class="err__msg">{{$errors->first('category4')}}</div>
                        @elseif($errors->has('category5'))
                        <div class="err__msg">{{$errors->first('category5')}}</div>
                        @endif

                        @foreach($category_data as $c_data)
                        <div class="myMenuCategory">
                            @if($c_data->category_no == 1)
                            <div class="myMenuCategory__color myMenuCategory__color--red"></div>
                            @elseif($c_data->category_no == 2)
                            <div class="myMenuCategory__color myMenuCategory__color--blue"></div>
                            @elseif($c_data->category_no == 3)
                            <div class="myMenuCategory__color myMenuCategory__color--orange"></div>
                            @elseif($c_data->category_no == 4)
                            <div class="myMenuCategory__color myMenuCategory__color--green"></div>
                            @elseif($c_data->category_no == 5)
                            <div class="myMenuCategory__color myMenuCategory__color--pink"></div>
                            @endif

                            @if($errors->has('category1') && $c_data->category_no == 1)
                            <input class="myMenuCategory__input" type="text" name="category1" autocomplete="off" value="{{old('category1')}}">
                            @elseif($errors->has('category2') && $c_data->category_no == 2)
                            <input class="myMenuCategory__input" type="text" name="category2" autocomplete="off" value="{{old('category2')}}">
                            @elseif($errors->has('category3') && $c_data->category_no == 3)
                            <input class="myMenuCategory__input" type="text" name="category3" autocomplete="off" value="{{old('category3')}}">
                            @elseif($errors->has('category4') && $c_data->category_no == 4)
                            <input class="myMenuCategory__input" type="text" name="category4" autocomplete="off" value="{{old('category4')}}">
                            @elseif($errors->has('category5') && $c_data->category_no == 5)
                            <input class=" myMenuCategory__input" type="text" name="category5" autocomplete="off" value="{{old('category5')}}">
                            @else
                            <input class="myMenuCategory__input" type="text" name="category{{$c_data->category_no}}" autocomplete="off" value="{{$c_data->category_name}}">
                            @endif

                            <p class="myMenuCategory__state">(8文字以内)</p>
                        </div>
                        @endforeach


                        <div class="btn__myMenu__user btn__form">
                            <input class="btn" type="submit" name="category_regist" value="登録">
                        </div>
                    </form>
        </section>
        <!-- メールアドレス変更 -->
        <section class="myMenu__parts myMenu__email toggle_wrap">
            <div class="myMenu__title toggle_switch">
                <p>メールアドレス変更</p>
            </div>
            <div class="form__content toggle_contents">
                <p class="form__descript">新しいメールアドレスを入力してください。</p>
                <div>
                    <label class="textfield__label" for="Email">メールアドレス(必須)</label>
                </div>
                <div class="err_msg"></div>
                <div class="textfield__area">
                    <input type="text" class="textfield__input" name="email" placeholder="メールアドレスを入力してください。" autocomplete="off">
                </div>
                <div class="btn__myMenu__user btn__form">
                    <input class="btn" type="submit" name="submit" value="送信">
                </div>
            </div>
        </section>
        <!-- パスワード変更 -->
        <section class="myMenu__parts myMenu__pass toggle_wrap">
            <div class="myMenu__title toggle_switch">
                <p>パスワード変更</p>

            </div>
            <div class="form__content toggle_contents">
                <p class="form__descript">パスワードを変更します。<br>
                    現在のパスワードと新しいパスワードを<br class="myMenu__descropt__line">入力してください。</p>
                <div>
                    <label class="textfield__label" for="Password">現在のパスワード</label>
                </div>
                <div class="err_msg"></div>
                <div class="textfield__area">
                    <input type="password" class="textfield__input" name="old_pass" placeholder="パスワードを入力してください。">
                </div>
                <div>
                    <label class="textfield__label" for="Password">新しいパスワード</label><span>&nbsp;&nbsp;&nbsp;半角英数字6文字以上</span>
                </div>
                <div class="err_msg"></div>
                <div class="textfield__area">
                    <input type="password" class="textfield__input" name="new_pass" placeholder="パスワードを入力してください。">
                </div>
                <div>
                    <label class="textfield__label" for="Password">新しいパスワード(確認)</label>
                </div>
                <div class="err_msg"></div>
                <div class="textfield__area">
                    <input type="password" class="textfield__input" name="new_pass_retry" placeholder="パスワードを入力してください。">
                </div>
                <div class="btn__myMenu__user btn__form">
                    <input class="btn" type="submit" name="submit" value="送信">
                </div>
            </div>


        </section>

        <!-- 退会 -->
        <section class="myMenu__parts myMenu__with toggle_wrap">
            <div class="myMenu__title toggle_switch">
                <p>退会</p>

            </div>
            <div class="form__content toggle_contents">
                <p class="form__descript withdraw__descropt">退会する場合は、<br class="myMenu__descropt__line">下記のボタンを押してください。</p>

                <div class="btn__myMenu__user btn__form">
                    <input class="btn" type="submit" name="submit" value="退会">
                </div>
            </div>

        </section>
    </div>


</main>


@endsection

@include('common.footer')