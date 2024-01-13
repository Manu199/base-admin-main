@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card-login m-auto">
        <div class="row justify-content-center">
            <div class="col">
                <div class="title-login my-5 text-center">BRAND</div>
                <div class="card">
                    <div class="card-header text-center bg-white border-0 my-3">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-4 row justify-content-center">
                                <div class="col">
                                    <input id="name" type="text" placeholder="Name" class="form-control custom-checkbox @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row justify-content-center">
                                <div class="col">
                                    <input id="lastname" type="text" placeholder="Lastname" class="form-control custom-checkbox @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                                    @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row justify-content-center">
                                <div class="col">
                                    <input id="date_of_birth" type="date" class="form-control custom-checkbox @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}" required autocomplete="date_of_birth" autofocus>

                                    @error('date_of_birth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row justify-content-center">
                                <div class="col">
                                    <input id="phone_number" type="tel" placeholder="Tel +00 123456789" class="form-control custom-checkbox @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number" autofocus>

                                    @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row justify-content-center">
                                <div class="col">
                                    <input id="email" placeholder="E-Mail Address" type="email" class="form-control custom-checkbox @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row justify-content-center">
                                <div class="col">
                                    <input id="password" placeholder="Password" type="password" class="form-control custom-checkbox @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row justify-content-center">
                                <div class="col">
                                    <input id="password-confirm" placeholder="Password confirm" type="password" class="form-control custom-checkbox" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="mb-4 row mb-0 justify-content-center">
                                <div class="col">
                                    <button type="submit" class="btn btn-dark w-100">
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
@endsection
