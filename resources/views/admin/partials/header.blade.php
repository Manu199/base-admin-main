<header class="navBar">
    <div class="container my-3">
        <div class="row">
            <!-- Logo -->
            <div class="col-2">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link btn fw-bold btn-header" href="{{ route('home') }}">
                            <img class="logo-header" src="/logo (1).png" alt="logo (1).png">
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Menú de hamburguesas y enlaces principales -->
            <div class="col-10 d-flex align-items-center justify-content-end">

                {{-- HAMBURGUER MENU --}}
                <button class="navbar-toggler d-md-none d-lg-none" type="button" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="box-header">

                </div>
                <div class="dropdown-menu dropdown-menu-end d-md-flex d-lg-flex border-0" aria-labelledby="navbarDropdown">
                    <ul class="nav">
                        <li class="nav-item mx-3">
                            <a class="nav-link btn fw-bold btn-header" href="{{ route('admin.apartment.index') }}">Lista Appartamenti</a>
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
</header>

</header>
