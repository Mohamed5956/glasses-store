<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a href="{{ url('/') }}" class="text-decoration-none">
                    <img src="{{ asset('img/logo.png') }}" class="w-25" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @if (Auth::user() && Auth::user()->role == 'admin')
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                            <li class="nav-item"><a class="nav-link {{ Request::is('/products') ? 'active' : '' }}"
                                    href="{{ url('/products') }}">Products</a></li>
                            <li class="nav-item"><a class="nav-link {{ Request::is('categories') ? 'active' : '' }}"
                                    href="{{ url('categories') }}">Categories</a></li>
                            <li class="nav-item"><a class="nav-link {{ Request::is('subcategories') ? 'active' : '' }}"
                                    href="{{ url('subcategories') }}">Subcategories</a></li>
                            <li class="nav-item"><a class="nav-link {{ Request::is('sales') ? 'active' : '' }}"
                                    href="{{ url('sales') }}">Sales</a></li>
                            <li class="nav-item"><a class="nav-link {{ Request::is('orders') ? 'active' : '' }}"
                                    href="{{ url('order') }}">Orders</a></li>

                        </ul>
                    @else
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item"><a class="nav-link {{ Request::is('/') ? 'active' : '' }}"
                                    href="{{ url('/') }}">Products</a></li>

                            <li class="nav-item"><a class="nav-link {{ Request::is('sales') ? 'active' : '' }}"
                                    href="{{ url('sales') }}">Sales</a></li>

                        </ul>
                    @endif
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav  mb-2 mb-lg-0 ms-lg-4 ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item"><a class="nav-link {{ Request::is('/login') ? 'active' : '' }}"
                                        href="{{ url('/login') }}">Login</a></li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item"><a class="nav-link {{ Request::is('/register') ? 'active' : '' }}"
                                        href="{{ url('/register') }}">Register</a></li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('cart.index') }}">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span id="cart-count" class="badge bg-light text-dark ms-1 rounded-pill"></span>
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script>
        $(document).ready(function() {
            $.get("{{ route('cart.count') }}", async function(data) {
                console.log(data);
                d = await data
                $('#cart-count').text(d.cartCount);
            });
        });
    </script>

    @yield('scripts')
</body>

</html>
