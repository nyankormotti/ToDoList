@section('header')


@if (Auth::check())

<body class="wrap wrap__main">
    @else

    <body class="wrap wrap__top">
        @endif
        <header class="header">
            <div class="header__section">
                <h1 class="header__section__title">
                    ToDoList
                </h1>

                <div class="menu__trigger js-toggle-sp--menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

                <nav class="nav__menu js-toggle-sp--menu-target">
                    <ul class="menu">
                        @if(!Auth::check())
                        <li class="menu__item"><a href="/" class="menu__link">Top</a></li>
                        <li class="menu__item"><a href="signup" class="menu__link menu__link--color">Sign Up</a></li>
                        <li class="menu__item"><a href="loginTask" class="menu__link">Login</a></li>
                        @else

                        <li class="menu__item"><a href="task" class="menu__link">Task</a></li>
                        <li class="menu__item"><a href="myMenu" class="menu__link menu__link--color">My Menu</a></li>
                        <li class="menu__item"><a href="logoutTask" class="menu__link">Logout</a></li>
                        @endif
                    </ul>
                </nav>
            </div>
        </header>
        <div class="header__dummy"></div>

        @if(!empty($status))
        <div id="js-msg" class="fadein" style="display:none;">{{$status}}</div>
        @endif

        @endsection