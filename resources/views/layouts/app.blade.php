<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- fONT AWESOME  --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">

        <header class="navBar">
            <div class="container my-3">
                <div class="row">
                    <!-- Logo -->
                    <div class="col-2">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link btn fw-bold" href="http://localhost:5000/">
                                    <img class="logo-header" src="/logo (1).png" alt="logo (1).png">
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-10 d-flex align-items-center justify-content-end">

                        <!-- {{-- HAMBURGUER MENU --}} -->
                        <button class="navbar-toggler d-md-none d-lg-none" type="button" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-bars"></i>
                        </button>

                        <div class="dropdown-menu dropdown-menu-end d-md-flex d-lg-flex border-0" aria-labelledby="navbarDropdown">

                          <div class="nav-item dropdown d-flex align-items-center ms-2">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-regular fa-user"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <ul>
                                    <li class="nav-item list-unstyled">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                    <li class="nav-item list-unstyled">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                </ul>

                                <form id="logout-form" action="#" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>


        <main class="">
            @yield('content')
        </main>
    </div>
</body>

</html>
