@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card-login m-auto">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="card ">
                        <div class="card-header text-center border-0 my-3 text-bold fs-3 text-body-secondary">
                            {{ __('Login') }}</div>

                        <div class="card-body justify-content-center">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-4 row justify-content-center">

                                    <div class="col">
                                        <input id="email" type="email" placeholder="E-mail"
                                            class="form-control custom-checkbox @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required autocomplete="email"
                                            autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4 row justify-content-center">

                                    <div class="col">
                                        <input id="password" type="password" placeholder="Password"
                                            class="form-control custom-checkbox @error('password') is-invalid @enderror"
                                            name="password" required autocomplete="current-password">



                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4 row justify-content-center">
                                    <div class="col">
                                        <div class="d-flex ">

                                            <div class="checkbox-wrapper-12">
                                                <div class="cbx">
                                                    <input id="remember" type="checkbox" name="remember"
                                                        {{ old('remember') ? 'checked' : '' }} />
                                                    <label class="form-check-label" for="remember"></label>
                                                    <svg width="15" height="14" viewbox="0 0 15 14" fill="none">
                                                        <path d="M2 8.36364L6.23077 12L13 2"></path>
                                                    </svg>
                                                </div>
                                                <!-- Gooey-->
                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
                                                    <defs>
                                                        <filter id="goo-12">
                                                            <fegaussianblur in="SourceGraphic" stddeviation="4"
                                                                result="blur"></fegaussianblur>
                                                            <fecolormatrix in="blur" mode="matrix"
                                                                values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 22 -7"
                                                                result="goo-12"></fecolormatrix>
                                                            <feblend in="SourceGraphic" in2="goo-12"></feblend>
                                                        </filter>
                                                    </defs>
                                                </svg>
                                            </div>
                                            <label class="form-check-label text-center ms-2 cursor-pointer" for="remember">
                                                {{ __('Ricordami') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4 row justify-content-center">
                                    <div class="col justify-content-center">
                                        <button type="submit" class="btn btn-custom-log w-100">
                                            {{ __('Login') }}
                                        </button>
                                        <p class="line-bar-text d-flex align-items-center my-2">
                                            o
                                        </p>
                                        <a href="{{ route('register') }}" id="button-register" type="submit"
                                            class="btn btn-custom-log w-100">
                                            {{ __('Registrati') }}
                                        </a>
                                    </div>
                                </div>
                                <div class="mb-4 row mb-0">
                                    <div class="col text-center">

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link text-black" href="{{ route('password.request') }}">
                                                {{ __('Password dimenticata?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
