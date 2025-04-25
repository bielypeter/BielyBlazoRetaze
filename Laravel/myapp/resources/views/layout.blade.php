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
        <form method="GET" action="{{ route('search') }}"class="search-form">
            <input type="text" name="q" placeholder="Search" class="search" value="{{ request('q') }}">
            <button type="submit">🔍</button> <!--could use an icon but this is simpler-->
        </form>
        <div class="menu-button-wrapper">
            @guest
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

    @if (Request::is('category*'))
    <form method="GET" action="{{ url()->current() }}">
        <div class="sidebar">
            <ul class="category-filters">
                <li class="price-ranges">
                    <h2>Price range</h2>
                    <span class="price-range-wrapper">
                        <input type="number" name="min" placeholder="Min" value="{{ request('min') }}" />
                        <div class="separator"></div>
                        <input type="number" name="max" placeholder="Max" value="{{ request('max') }}" />
                    </span>
                </li>
                <li class="filter-list">
                    <h2>Brand</h2>
                    <ul>
                        @foreach (['Razer', 'Trust', 'HyperX', 'Keychron'] as $brand)
                            <li class="filter">
                                <input type="checkbox" name="brand[]" value="{{ $brand }}" {{ in_array($brand, request('brand', [])) ? 'checked' : '' }}>
                                <p>{{ $brand }}</p>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="filter-list">
                    <h2>Color</h2>
                    <ul>
                        @foreach (['Red', 'Green', 'Turquise', 'Cyan'] as $color)
                            <li class="filter">
                                <input type="checkbox" name="color[]" value="{{ $color }}" {{ in_array($color, request('color', [])) ? 'checked' : '' }}>
                                <p>{{ $color }}</p>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
            <button type="submit" class="category-button">Filter</button>
        </div>
    </form>
    @else
        <div class="sidebar">
        <ul class="categories">
            <li><a href="{{ url('/category/Keyboards') }}" class="category-button">Keyboards</a></li>
            <li><a href="{{ url('/category/Keycaps') }}" class="category-button">Keycaps</a></li>
            <li><a href="{{ url('/category/Switches') }}" class="category-button">Switches</a></li>
            <li><a href="{{ url('/category/Cases') }}" class="category-button">Cases</a></li>
            <li><a href="{{ url('/category/Accessories') }}" class="category-button">Accessories</a></li>
            <li><a href="{{ url('/category/PCBs') }}" class="category-button">PCBs</a></li>
        </ul>
    </div>
    @endif






    

    @yield('content')
</body>
</html>
