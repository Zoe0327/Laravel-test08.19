<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FashionableLate</title>
    <link rel="stylesheet" href=" {{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href=" {{ asset('css/common.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inika&display=swap" rel="stylesheet">
    @yield('css')
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">
                <div class="header-nav-left">
                    <!--CSS調整のための空白-->
                </div>
                <a href="/" class="header__logo">FashionablyLate</a>
                <nav class="header-nav-right">
                    <ul class="header-nav">
                        @if (!request()->is('/') && !request()->is('/','contacts/confirm'))
                        <li class="header-nav__item">
                            @if (request()->is('login'))
                                <a class="header-nav__link" href="/register">Register</a>
                            @elseif (request()->is('register'))
                                <a class="header-nav__link" href="/login">Login</a>
                            @elseif (request()->is('admin'))
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="header-nav__link" type="submit" >Logout</button>
                            </form>
                            @else
                                <a class="header-nav__link" href="/login">Login</a>
                            @endif
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <main class="main">
        @yield('content')
    </main>
</body>
</html>