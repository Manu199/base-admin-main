<header class="my-3 row justify-content-between">

    <div class=" col-2">
        <ul class="nav ps-4">
            <li class="nav-item">
                <a class="nav-link btn fw-bold btn-header {{ Route::currentRouteName() === 'home' ? 'text-bg-info' : ''}}" href="{{ route('admin.home') }}">Home</a>
            </li>
        </ul>

    </div>
    <div class="col-6 ">
        <ul class="nav justify-content-end pe-4">
            <li class="nav-item">
                <a class="nav-link btn fw-bold btn-header {{ Route::currentRouteName() === 'home' ? 'text-bg-info' : ''}}" href="{{ route('admin.apartment.index') }}">Apartments List</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn fw-bold btn-header-2 {{ Route::currentRouteName() === 'home' ? 'text-bg-info' : ''}}" href="{{ route('admin.apartment.create') }}"><i class="fa-solid fa-plus"></i> New Apartment</a>
            </li>
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
