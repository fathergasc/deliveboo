<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>Deliveboo - @yield('title')</title>
</head>
<body>

    <main class="d-flex">

        <div class="left">
            <nav class="sidebar">
                <div class="logo mb-4">
                    <h2>Deliveboo</h2>
                </div>
                <ul class="menu">
                    <li class="menu_item">
                        <i class="ri-store-2-fill"></i>
                        <a class="nav-link" href="{{ route('admin.home') }}">Dashboard</a>
                    </li>
                    <li class="menu_item"><a class="nav-link" href="{{ route('admin.products.index') }}">Products</a></li>
                    <li class="menu_item"><a class="nav-link" href="{{ route('admin.orders.index') }}">Orders</a></li>
                </ul>
            </nav>
        </div>

        <div class="right">
            <header>
                @include('partials.header')
            </header>
            <section>
                @yield('content')
            </section>
            <!-- footer -->
        </div>

    </main>
</body>
</html>
