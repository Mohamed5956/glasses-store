<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('glasses/img/favicon.ico') }}" rel="icon">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/sass/style.css', 'resources/sass/owl.carousel.min.css'])
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    {{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> --}}
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    <style>
        .dropdown2:hover .dropdown2-menu {
            display: block;
        }
    </style>
</head>

<body>
    <div id="app">

        <!-- Topbar Start -->
        <div class="container-fluid">
            <div class="row bg-secondary py-2 px-xl-2">
                <div class="col-lg-3 d-none d-lg-block">
                    <a href="{{ url('/') }}" class="text-decoration-none w-25">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span
                                class="text-primary font-weight-bold border px-3 mr-1">Eye</span>Boutique</h1>
                    </a>
                </div>
            </div>
            <div class="row align-items-center  px-xl-5">
                <div class="col-lg-3 d-none d-lg-block">
                    <a href="{{ url('/') }}" class="text-decoration-none">
                        <img src="{{ asset('img/logo.png') }}"  class="w-50" alt="">
                    </a>
                </div>

                <div class="col-lg-6 col-6 text-left">

                </div>
                <div class="col-lg-3 col-6 text-right">
                    <div class="nav-item">
                        <a class="nav-link" href="{{ route('cart.index') }}">
                            <i class="fas fa-shopping-cart"></i>
                            <span id="cart-count" class="badge bg-light text-dark ms-1 rounded-pill"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Topbar End -->
        <div class="container-fluid mb-5">
            <div class="row border-top px-xl-5">
                <div class="col-lg-3 d-none d-lg-block">
                    <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
                        data-toggle="collapse" href="#navbar-vertical"
                        style="height: 65px; margin-top: -1px; padding: 0 30px;">
                        <h6 class="m-0">Categories</h6>
                        <i class="fa fa-angle-down text-dark"></i>
                    </a>
                    @include('layouts.sidebar')
                </div>
                <div class="col-lg-9">
                    <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                        <a href="" class="text-decoration-none d-block d-lg-none">
                            <img src="./logo.png" alt="">
                            <!-- <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1> -->
                        </a>
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#navbarSupportedContent">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            @if (Auth::user() && Auth::user()->role == 'admin')
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                                    <li class="nav-item"><a class="nav-link {{ Request::is('/') ? 'active' : '' }}"
                                            href="{{ url('/') }}">Home</a></li>
                                    <li class="nav-item"><a
                                            class="nav-link {{ Request::is('/products') ? 'active' : '' }}"
                                            href="{{ url('/products') }}">Products</a></li>

                                    <li class="nav-item"><a
                                            class="nav-link {{ Request::is('categories') ? 'active' : '' }}"
                                            href="{{ url('categories') }}">Categories</a></li>
                                    <li class="nav-item"><a
                                            class="nav-link {{ Request::is('subcategories') ? 'active' : '' }}"
                                            href="{{ url('subcategories') }}">Subcategories</a></li>
                                    <li class="nav-item"><a class="nav-link {{ Request::is('sales') ? 'active' : '' }}"
                                            href="{{ url('sales') }}">Sales</a></li>
                                    <li class="nav-item"><a
                                            class="nav-link {{ Request::is('orders') ? 'active' : '' }}"
                                            href="{{ url('order') }}">Orders</a></li>

                                </ul>
                            @else
                                <ul class="navbar-nav me-auto">
                                    <li class="nav-item"><a class="nav-link {{ Request::is('/') ? 'active' : '' }}"
                                            href="{{ url('/') }}">Home</a></li>

                                    <li class="nav-item"><a class="nav-link {{ Request::is('sales') ? 'active' : '' }}"
                                            href="{{ url('sales') }}">Sales</a></li>

                                </ul>
                            @endif
                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav  mb-2 mb-lg-0 ms-lg-4 ms-auto">
                                <!-- Authentication Links -->
                                @guest
                                    @if (Route::has('login'))
                                        <li class="nav-item"><a
                                                class="nav-link {{ Request::is('/login') ? 'active' : '' }}"
                                                href="{{ url('/login') }}">Login</a></li>
                                    @endif

                                    @if (Route::has('register'))
                                        <li class="nav-item"><a
                                                class="nav-link {{ Request::is('/register') ? 'active' : '' }}"
                                                href="{{ url('/register') }}">Register</a></li>
                                    @endif
                                @else
                                  
                                    <li class="nav-item dropdown dropdown2">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                            role="button" data-bs-toggle="dropdown2" aria-haspopup="true"
                                            aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }}
                                        </a>

                                        <div class="dropdown-menu dropdown2-menu dropdown-menu-end"
                                            aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>

                                @endguest
                            </ul>
                        </div>
                    </nav>
                    <div id="header-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active" style="height: 410px;">
                                <img class="img-fluid" style="background-size: contain" src="{{ asset('img/carousel-1.jpg') }}" alt="Image">
                    
                                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 700px;">
                                        <h4 class="text-light text-uppercase font-weight-medium mb-3">Get 10% Off Your First Order</h4>
                                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">Discover Stylish Glasses</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item" style="height: 410px;">
                                <img class="img-fluid" style="background-size: contain" src="{{ asset('img/carousel-2.jpg') }}" alt="Image">
                                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 700px;">
                                        <h4 class="text-light text-uppercase font-weight-medium mb-3">Get 10% Off Your First Order</h4>
                                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">Shop Affordable Glasses</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                                <span class="carousel-control-prev-icon mb-n2"></span>
                            </div>
                        </a>
                        <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                                <span class="carousel-control-next-icon mb-n2"></span>
                            </div>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
        <main class="py-4">
            @yield('content')
        </main>
        <!-- Footer Start -->
        <!-- Footer Start -->
<footer class="container-fluid bg-secondary text-dark mt-5 pt-5">
    <div class="row px-xl-5 pt-5">
        <div class="col-lg-12 col-md-12">
            <div class="row d-flex justify-content-center">
                        <p class="text-center text-muted">&copy; 2023 Your Website. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer End -->

        <!-- Footer End -->
    </div>


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <!-- Template Javascript -->
    @vite(['resources/glasses/js/main.js', 'resources/glasses/lib/easing/easing.min.js', 'resources/glasses/lib/owlcarousel/owl.carousel.min.js', 'resources/glasses/mail/contact.js', 'resources/glasses/mail/jqBootstrapValidation.min.js'])

    <script>
        $(document).ready(function() {
            $.get("{{ route('cart.count') }}", async function(data) {
                console.log(data);
                d = await data
                $('#cart-count').text(d.cartCount);
            });
        });
    </script>
    <script>
        // Delay in milliseconds
        const delay = 3000;

        // Get the message container element
        const messageContainer = document.getElementById('message-container');
        if (messageContainer) {
            // Hide the message after a delay
            setTimeout(function() {
                messageContainer.style.display = 'none';
            }, delay);
        }
    </script>


    @yield('scripts')
</body>

</html>
