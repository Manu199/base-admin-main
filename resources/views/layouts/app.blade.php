<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Font Figtree --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree&display=swap" rel="stylesheet">

    {{-- Font Awesome  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">
        <div class="container">

            <nav class="navbar navbar-expand-lg w-100 justify-content-between">
                <a class="navbar-brand" href="http://localhost:5000/">
                    <img class="logo-header" src="/logo (1).png" alt="logo (1).png" />
                </a>

                <div class="d-flex">
                    <ul class="navbar-nav">
                        <li>
                            <a class="nav-link text-black" href="http://localhost:5000/ricerca-avanzata">
                                Ricerca Avanzata
                            </a>
                        </li>
                        <li>
                            <a class="nav-link text-black" href="{{ route('admin.apartment.index') }}">Lista
                                Appartamenti</a>
                        </li>
                        <li>
                            <a class="nav-link text-black" href="{{ route('admin.apartment.create') }}">Nuovo
                                Appartamento</a>
                        </li>
                    </ul>


                    <div class="collapse navbar-collapse d-flex justify-content-end"
                        aria-labelledby="navbarDropdown"id="navbarNavDarkDropdown">

                        <a id="navbarDropdown" class="nav-link user-name" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa-solid fa-bars"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="dropdown-item">
                                <a class="nav-link text-black" href="{{ url('profile') }}"><i
                                        class="fa-solid fa-user me-2"></i>{{ __('Profilo') }}</a>
                            </li>
                            <li class="dropdown-item">
                                <a class="nav-link text-black" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i
                                        class="fa-solid fa-right-from-bracket fa-flip-horizontal me-2"></i>{{ __('Logout') }}
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>

                    </div>

            </nav>
        </div>


        <main class="">
            @yield('content')
        </main>
    </div>
</body>

</html>
