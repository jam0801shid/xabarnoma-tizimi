<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJ01YQd8jFfXXR9R7z3aP6uKftdF/hS15RQbsr18fdiR7z9mO7O/pP7XkOGv" crossorigin="anonymous">

        <!-- Bootstrap Icons CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <!-- Bootstrap JS and Popper.js -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
            @yield('content')
            </main>
        </div>
        <footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row">
            <!-- Footer Logo va Ijtimoiy Tarmoqlar -->
            <div class="col-md-4 mb-4">
                <a href="{{ url('/') }}" class="text-white text-decoration-none fs-3 fw-bold">
                    MyNewsSite
                </a>
                <p class="mt-3">Yangiliklar va dolzarb ma'lumotlar manbai. O'zingizni xabardor qiling!</p>
                <div class="d-flex mt-3">
                    <a href="#" class="text-white me-3"><i class="bi bi-facebook fs-4"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-twitter fs-4"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-instagram fs-4"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-linkedin fs-4"></i></a>
                </div>
            </div>

            <!-- Menyu -->
            <div class="col-md-2 mb-4">
                <h5 class="fw-bold">Menyu</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('news.index') }}" class="text-white text-decoration-none">Yangiliklar</a></li>
                    <li><a href="/" class="text-white text-decoration-none">Kategoriyalar</a></li>
                    <li><a href="/" class="text-white text-decoration-none">Biz haqimizda</a></li>
                    <li><a href="/" class="text-white text-decoration-none">Aloqa</a></li>
                </ul>
            </div>

            <!-- Foydalanuvchi Havolalari -->
            <div class="col-md-2 mb-4">
                <h5 class="fw-bold">Foydalanuvchilar uchun</h5>
                <ul class="list-unstyled">
                    @guest
                        <li><a href="{{ route('login') }}" class="text-white text-decoration-none">Kirish</a></li>
                        <li><a href="{{ route('register') }}" class="text-white text-decoration-none">Ro'yxatdan o'tish</a></li>
                    @else
                        <li><a href="/" class="text-white text-decoration-none">Profil</a></li>
                        <li><a href="{{ route('logout') }}" class="text-white text-decoration-none"
                               onclick="event.preventDefault(); document.getElementById('logout-form-footer').submit();">
                            Chiqish
                        </a></li>
                        <form id="logout-form-footer" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest
                </ul>
            </div>

            <!-- Manzil va Aloqa -->
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold">Biz bilan bog'lanish</h5>
                <p><i class="bi bi-geo-alt"></i> Manzil: Tashkent, Uzbekistan</p>
                <p><i class="bi bi-telephone"></i> Telefon: +998 90 000 0000</p>
                <p><i class="bi bi-envelope"></i> Email: support@mynewssite.com</p>
            </div>
        </div>

        <!-- Copyright va Boshqa Havolalar -->
        <div class="row mt-4">
            <div class="col-12 text-center">
                <p class="mb-0">© 2024 MyNewsSite. Barcha huquqlar himoyalangan.</p>
            </div>
        </div>
    </div>
</footer>

    </body>
</html>
