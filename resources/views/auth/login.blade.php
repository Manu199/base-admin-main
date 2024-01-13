@extends('layouts.app')

@section('content')
<div class="container mt-4 card-login">
    <div class="row justify-content-center">
        <div class=" col-sm-8 col-md-8 col-xl-6">
            <div class="title-login my-5 text-center">BRAND</div>
            <div class="card ">
                <div class="card-header text-center border-0 my-3 text-bold">{{ __('Login') }}</div>

                <div class="card-body justify-content-center">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4 row justify-content-center">

                            <div class="col">
                                <input id="email" type="email" placeholder="E-mail" class="form-control custom-checkbox @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row justify-content-center">

                            <div class="col">
                                <input id="password" type="password" placeholder="Password" class="form-control custom-checkbox @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row justify-content-center">
                            <div class="col text-center">
                                <div class="form-check">
                                    <input class="form-check-input custom-check" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 row justify-content-center">
                            <div class="col justify-content-center">
                                <button type="submit" class="btn btn-dark w-100">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                        <div class="mb-4 row mb-0">
                            <div class="col text-center">

                                @if (Route::has('password.request'))
                                <a class="btn btn-link text-black" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
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
@endsection
