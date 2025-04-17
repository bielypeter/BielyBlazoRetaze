<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wtech</title>
    <link rel="stylesheet" href="{{ asset('styles/index.css') }}">
    @stack('styles')
</head>
<body>
    <header class="header">
        <a href="{{ url('/') }}">
            <img src="{{ asset('assets/logo.svg') }}" alt="Logo image" class="logo" />
        </a>
        <input type="text" placeholder="Search" class="search" />
        <div class="menu-button-wrapper">
            <@guest
                <a href="{{ route('login') }}"><button class="login-button">Login</button></a>
                <a href="{{ route('register') }}"><button class="register-button">Register</button></a>
            @endguest
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="logout-button">Logout</button>
                </form>
            @endauth
            <a href="{{ url('/checkout') }}">
                <button class="checkout-button">
                    <img src="{{ asset('assets/checkout-svgrepo-com.svg') }}" alt="Checkout icon"/>
                </button>
            </a>
        </div>
    </header>

    <div class="sidebar">
        <ul class="categories">
            <li><a href="{{ url('/category') }}" class="category-button">Keyboard</a></li>
            <li><a href="{{ url('/category') }}" class="category-button">Keycaps</a></li>
            <li><a href="{{ url('/category') }}" class="category-button">Switches</a></li>
            <li><a href="{{ url('/category') }}" class="category-button">Case</a></li>
            <li><a href="{{ url('/category') }}" class="category-button">Accessories</a></li>
            <li><a href="{{ url('/category') }}" class="category-button">PCB</a></li>
        </ul>
    </div>

    @yield('content')
</body>
</html>
