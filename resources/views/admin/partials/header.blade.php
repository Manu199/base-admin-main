<header>
    <nav class="navbar">
        <div class="container">
            <div class="row w-100">

                <nav class="navbar navbar-expand-lg w-100">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="http://localhost:5000/">
                            <img class="logo-header" src="/logo (1).png" alt="logo (1).png" />
                        </a>

                        <div class="d-flex">
                            <ul class="navbar-nav">
                                <li class="dropdown-item">
                                    <a class="nav-link text-black" href="http://localhost:5000/ricerca-avanzata">
                                        Ricerca Avanzata
                                    </a>
                                </li>
                                <li class="dropdown-item">
                                    <a class="nav-link text-black" href="{{ route('admin.apartment.index') }}">Lista
                                        Appartamenti</a>
                                </li>
                                <li class="dropdown-item">
                                    <a class="nav-link text-black" href="{{ route('admin.apartment.create') }}">Nuovo
                                        Appartamento</a>
                                </li>
                            </ul>

                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNavDarkDropdown">

                                <button class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-bars"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-item">
                                        <a class="nav-link text-black" href="{{ url('profile') }}"><i
                                                class="fa-solid fa-user me-2"></i>{{ __('Profilo') }}</a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a class="nav-link text-black" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fa-solid fa-right-from-bracket me-2"></i>{{ __('Logout') }}
                                        </a>
                                    </li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </ul>

                            </div>
                        </div>
                    </div>
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
                </nav>

                {{-- <div class="col-2 left">
                    <router-link class="nav-link btn fw-bold" :to="{ name: 'Home' }" href="#">
                        <img class="logo-header" src="/logo (1).png" alt="logo (1).png" />
                    </router-link>
                    <a href="http://localhost:5000/">
                        <img class="logo-header" src="/logo (1).png" alt="logo (1).png" />
                    </a>
                </div> --}}


                {{-- <div class="dropdown">

                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        menu
                    </button>
                    <ul class="navbar-nav dropdown-menu">
                        <li class="nav-item dropdown-item">
                            <a class="nav-link" href="http://localhost:5000/ricerca-avanzata">
                                <div class="_btn">Ricerca Avanzata</div>
                            </a>
                        </li>
                        <li class="nav-item dropdown-item">
                            <a class="nav-link" href="{{ route('admin.apartment.index') }}">Lista Appartamenti</a>
                        </li>
                        <li class="nav-item new-apartment dropdown-item">
                            <a class="nav-link" href="{{ route('admin.apartment.create') }}"><i
                                    class="fa-solid fa-plus"></i>Nuovo Appartamento</a>
                        </li>
                    </ul>
                </div> --}}
                {{-- <div class="col-10 d-flex align-items-center justify-content-end right">
                        <button class="navbar-toggle d-md-none d-lg-none" type="button" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-bars"></i>
                        </button>
                        --}}
                {{-- dropdown utente --}}
                {{-- <div class="nav-item dropdown d-flex align-items-center ms-2">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profilo') }}</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>  --}}
                {{-- </div> --}}
            </div>
        </div>
    </nav>
</header>




{{-- <header class="navBar">
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

            <!-- Menú de hamburguesas y enlaces principales -->
            <div class="col-10 d-flex align-items-center justify-content-end">

                {{-- <button class="navbar-toggler d-md-none d-lg-none" type="button" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="box-header">

                </div>
                <div class="dropdown-menu dropdown-menu-end d-md-flex d-lg-flex border-0"
                    aria-labelledby="navbarDropdown">
                    <ul class="nav">
                        <li class="nav-item mx-3">
                            <a class="nav-link btn fw-bold btn-header" href="{{ route('admin.apartment.index') }}">Lista
                                Appartamenti</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn fw-bold btn-header-2" href="{{ route('admin.apartment.create') }}">
                                <i class="fa-solid fa-plus"></i> Nuovo Appartamento
                            </a>
                        </li>

                    </ul>
                    <div class="nav-item dropdown d-flex align-items-center ms-2">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profilo') }}</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>  --}}
