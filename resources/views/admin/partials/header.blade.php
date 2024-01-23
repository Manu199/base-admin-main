<header>
    <nav class="navbar">
        <div class="container">

            <nav class="navbar navbar-expand w-100 justify-content-between">

                <a class="navbar-brand" href="http://localhost:5000/">
                    <img class="logo-header" src="/logo (1).png" alt="logo (1).png" />
                </a>

                <div class="d-flex d-none d-lg-block    ">

                    <ul class="navbar-nav ">

                        @guest
                            <li class="nav-item">
                                <a class="nav-link btn custom-btn-primary" href="http://localhost:5000">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn custom-btn-primary "
                                    href="http://localhost:5000/ricerca-avanzata">Ricerca
                                    Avanzata</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link btn custom-btn-primary" href="http://localhost:5000">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn custom-btn-primary   "
                                    href="http://localhost:5000/ricerca-avanzata">Ricerca
                                    Avanzata</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn custom-btn-primary   {{ Route::currentRouteName() === 'admin.apartment.index' ? 'active' : '' }}"
                                    href="{{ route('admin.apartment.index') }}">Lista Appartamenti</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link btn custom-btn-primary  {{ Route::currentRouteName() === 'admin.apartment.create' ? 'active' : '' }}"
                                    href="{{ route('admin.apartment.create') }}"><i class="fa-solid fa-plus"></i>
                                    Nuovo
                                    Appartamento</a>
                            </li>
                        @endguest

                        <!-- Authentication Links -->
                        @guest

                            <li class="nav-item dropdown d-flex justify-content-end align-items-center">
                                <i id="navbarDropdown" class="fa-regular fa-user dropdown-toggle ms-2" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre></i>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('home') }}">Area personale</a>

                                    @if (Route::has('register'))
                                        <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    @endif
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle user-name" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('home') }}">Area personale</a>
                                    <a class="dropdown-item" href="{{ url('profile') }}">Profilo</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
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




                {{-- MENU MOBILE --}}



                <div class="d-flex d-lg-none">

                    <ul class="navbar-nav ">


                        <li class="nav-item">
                            <a class="nav-link btn custom-btn-primary" href="http://localhost:5000">Home</a>
                        </li>

                        <!-- Authentication Links -->

                        @guest

                            <li class="nav-item dropdown d-flex justify-content-end align-items-center">
                                <i id="navbarDropdown" class="fa-regular fa-user dropdown-toggle ms-2" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre></i>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="http://localhost:5000/ricerca-avanzata">Ricerca
                                        Avanzata</a>
                                    <a class="dropdown-item" href="{{ url('profile') }}">Area personale</a>

                                    @if (Route::has('register'))
                                        <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    @endif
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle user-name" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="http://localhost:5000/ricerca-avanzata">Ricerca
                                        Avanzata</a>
                                    <a class="dropdown-item" href="{{ route('admin.apartment.index') }}">Lista
                                        Appartamenti</a>
                                    <a class="dropdown-item" href="{{ route('admin.apartment.create') }}"><i
                                            class="fa-solid fa-plus"></i>
                                        Nuovo
                                        Appartamento</a>

                                    <a class="dropdown-item" href="{{ route('home') }}">Area personale</a>
                                    <a class="dropdown-item" href="{{ url('profile') }}">Profilo</a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
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

        </div>

    </nav>
</header>
