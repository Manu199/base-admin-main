<header class="my-3">
    <ul class="nav justify-content-center gap-2">
        <li class="nav-item">
            <a class="nav-link btn fw-bold text-bg-primary {{ Route::currentRouteName() === 'home' ? 'text-bg-info' : ''}}" href="{{ route('admin.home') }}">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn fw-bold text-bg-primary {{ Route::currentRouteName() === 'home' ? 'text-bg-info' : ''}}" href="{{ route('admin.apartment.index') }}">Apartments List</a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn fw-bold text-bg-primary {{ Route::currentRouteName() === 'home' ? 'text-bg-info' : ''}}" href="{{ route('admin.apartment.create') }}">New Apartment</a>
        </li>
    </ul>
</header>
