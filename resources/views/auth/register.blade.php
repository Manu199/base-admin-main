@extends('layouts.app')

@section('content')
    <style>
        .icon-input {
            position: absolute;
            top: 50%;
            right: 25px;
            transform: translate(-50%, -50%)
        }
    </style>


    <div class="container my-5">
        <div class="card-login m-auto">
            <div class="row justify-content-center">
                <div class="col">
                    {{-- <div class="title-login my-5 text-center">BRAND</div> --}}
                    <div class="card">
                        <div class="card-header text-center bg-white border-0 my-3">{{ __('Register') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}" onsubmit="return validateForm()">
                                @csrf

                                <div class="mb-4 row justify-content-center">
                                    <div class="col position-relative">
                                        <input
                                            id="name"
                                            type="text"
                                            placeholder="Name"
                                            class="form-control custom-checkbox pe-5 @error('name') is-invalid @enderror"
                                            name="name"
                                            value="{{ old('name') }}"
                                            required
                                            autocomplete="name"
                                            autofocus>
                                        <span class="icon-input" id="icon-name"></span>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4 row justify-content-center">
                                    <div class="col position-relative">
                                        <input id="lastname" type="text" placeholder="Lastname"
                                            class="form-control custom-checkbox pe-5 @error('lastname') is-invalid @enderror"
                                            name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname"
                                            autofocus>
                                        <span class="icon-input" id="icon-lastname"></span>


                                        @error('lastname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4 row justify-content-center">
                                    <div class="col ">
                                        <input id="date_of_birth" type="date"
                                            class="form-control custom-checkbox @error('date_of_birth') is-invalid @enderror"
                                            name="date_of_birth" value="{{ old('date_of_birth') }}"
                                            max="{{ date('Y-m-d', strtotime('-18 years')) }}" required
                                            autocomplete="date_of_birth" autofocus>

                                        @error('date_of_birth')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4 row justify-content-center">
                                    <div class="col position-relative">
                                        <input id="phone_number" type="tel" placeholder="Tel +00 123456789"
                                            class="form-control custom-checkbox pe-5 @error('phone_number') is-invalid @enderror"
                                            name="phone_number" value="{{ old('phone_number') }}" required
                                            autocomplete="phone_number" autofocus>
                                        <span class="icon-input" id="icon-phone_number"></span>

                                        @error('phone_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4 row justify-content-center">
                                    <div class="col position-relative">
                                        <input id="email" placeholder="E-Mail Address" type="email"
                                            class="form-control custom-checkbox pe-5 @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required autocomplete="email">
                                        <span class="icon-input" id="icon-email"></span>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4 row justify-content-center">
                                    <div class="col position-relative">
                                        <input id="password" placeholder="Password" type="password"
                                            class="form-control custom-checkbox pe-5 @error('password') is-invalid @enderror"
                                            name="password" required autocomplete="new-password">
                                        <span class="icon-input" id="icon-password"></span>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4 row justify-content-center">
                                    <div class="col position-relative">
                                        <input id="password-confirm" placeholder="Password confirm" type="password"
                                            class="form-control custom-checkbox pe-5" name="password_confirmation" required
                                            autocomplete="new-password">
                                        <span class="icon-input" id="icon-password-confirm"></span>
                                    </div>
                                </div>

                                <div class="mb-4 row mb-0 justify-content-center">
                                    <div class="col">
                                        <button id="button-register" type="submit" class="btn btn-dark w-100">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        // Name
        const name = document.getElementById('name');
        name.addEventListener('input', function() {
            const iconName = document.getElementById('icon-name');
            if (name.value.length < 1) {
                iconName.innerHTML = '&#x2718;';
                iconName.classList.add('text-danger');
                iconName.classList.remove('text-success');
            } else {
                iconName.innerHTML = '&#x2714;';
                iconName.classList.add('text-success');
                iconName.classList.remove('text-danger');

            }
        });

        // Lastname
        const lastname = document.getElementById('lastname');
        lastname.addEventListener('input', function() {
            const iconLastname = document.getElementById('icon-lastname');
            if (lastname.value.length < 1) {
                iconLastname.innerHTML = '&#x2718;';
                iconLastname.classList.add('text-danger');
                iconLastname.classList.remove('text-success');
            } else {
                iconLastname.innerHTML = '&#x2714;';
                iconLastname.classList.add('text-success');
                iconLastname.classList.remove('text-danger');
            }
        });

        // Phone Number
        const phoneNumber = document.getElementById('phone_number');
        phoneNumber.addEventListener('input', function() {
            const icon = document.getElementById('icon-phone_number');
            if (/^\+\d+\s*\d{4,15}$/.test(phoneNumber.value)) {
                icon.innerHTML = '&#x2714;';
                icon.classList.add('text-success');
                icon.classList.remove('text-danger');
                phoneNumber.setCustomValidity('');
            } else {
                icon.innerHTML = '&#x2718;';
                icon.classList.add('text-danger');
                icon.classList.remove('text-success');
                phoneNumber.setCustomValidity('Deve essere con prefisso internazionale es.+00 123456789');
            }
        });

        // Email
        const email = document.getElementById('email');
        email.addEventListener('input', function() {
            const icon = document.getElementById('icon-email');
            const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (emailRegex.test(email.value)) {
                icon.innerHTML = '&#x2714;';
                icon.classList.add('text-success');
                icon.classList.remove('text-danger');
                email.setCustomValidity('');
            } else {
                icon.innerHTML = '&#x2718;';
                icon.classList.add('text-danger');
                icon.classList.remove('text-success');
                email.setCustomValidity('Indirizzo email non valido, es. email@example.com');
            }
        });

        // Password
        const password = document.getElementById('password');
        password.addEventListener('input', function() {
            const icon = document.getElementById('icon-password');
            if (password.value.length >= 8) {
                icon.innerHTML = '&#x2714;';
                icon.classList.add('text-success');
                icon.classList.remove('text-danger');
                password.setCustomValidity('');
            } else {
                icon.innerHTML = '&#x2718;';
                icon.classList.add('text-danger');
                icon.classList.remove('text-success');
                password.setCustomValidity('La password deve essere di almeno 8 caratteri');
            }
        });

        // Confirm Password
        const confirmPassword = document.getElementById('password-confirm');
        confirmPassword.addEventListener('input', function() {
            const icon = document.getElementById('icon-password-confirm');
            if (password.value !== confirmPassword.value) {
                icon.innerHTML = '&#x2718;';
                icon.classList.add('text-danger');
                icon.classList.remove('text-success');
                confirmPassword.setCustomValidity('Le password non corrispondono');
            } else {
                icon.innerHTML = '&#x2714;';
                icon.classList.remove('text-danger');
                icon.classList.add('text-success');
                confirmPassword.setCustomValidity('');
            }
        });
    </script>
@endsection
