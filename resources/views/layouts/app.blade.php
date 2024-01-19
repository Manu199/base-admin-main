<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- font Figtree --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree&display=swap" rel="stylesheet">

    {{-- fONT AWESOME  --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">

        <nav class="navbar">
            <div class="container">
                <div class="row w-100">

                    <div class="col-4 left">
                        <router-link class="nav-link btn fw-bold" :to="{ name: 'Home' }" href="#">
                            <img class="logo-header" src="/logo (1).png" alt="logo (1).png" />
                        </router-link>
                    </div>

                    <div class="col-4 middle">
                        <a href="http://localhost:5000/ricerca-avanzata">
                            <div class="_btn">Ricerca Avanzata</div>
                        </a>
                    </div>

                    <div class="col-4 right">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="http://127.0.0.1:8000/login">Accedi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="http://127.0.0.1:8000/register">Registrati</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </nav>


        <main class="">
            @yield('content')
        </main>
    </div>
</body>

</html>
