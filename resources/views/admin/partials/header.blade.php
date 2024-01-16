<header class="my-3 row justify-content-between">

    <div class=" col-2">
        <ul class="nav ps-4">
            <li class="nav-item">
                <a class="nav-link btn fw-bold btn-header {{ Route::currentRouteName() === 'home' ? 'active' : '' }}"
                    href="{{ route('home') }}">Home</a>
            </li>
        </ul>

    </div>
    <div class="col-6 ">
        <ul class="nav justify-content-end pe-4">
            <li class="nav-item mx-3">
                <a class="nav-link btn fw-bold btn-header {{ Route::currentRouteName() === 'admin.apartment.index' ? 'active' : '' }}"
                    href="{{ route('admin.apartment.index') }}">Apartments List</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn fw-bold btn-header-2 {{ Route::currentRouteName() === 'admin.apartment.create' ? 'active' : '' }}"
                    href="{{ route('admin.apartment.create') }}"><i class="fa-solid fa-plus"></i> New Apartment</a>
            </li>

            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profile') }}</a>
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
    {{-- <ul class="nav justify-content-center gap-2">
        <li class="nav-item">
            <a class="nav-link btn fw-bold btn-header {{ Route::currentRouteName() === 'home' ? 'text-bg-info' : ''}}" href="{{ route('admin.home') }}">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn fw-bold btn-header {{ Route::currentRouteName() === 'home' ? 'text-bg-info' : ''}}" href="{{ route('admin.apartment.index') }}">Apartments List</a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn fw-bold btn-header-2 {{ Route::currentRouteName() === 'home' ? 'text-bg-info' : ''}}" href="{{ route('admin.apartment.create') }}"><i class="fa-solid fa-plus"></i> New Apartment</a>
        </li>
    </ul> --}}

</header>
