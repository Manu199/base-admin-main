@extends('layouts.main')

@section('content')
<div class="home">
    <h1 class="my-3 text-center ">WELCOME</h1>
    <div class="text-center">
        <a class="btn btn-secondary" href="{{route('admin.home')}}">Login</a>
    </div>
</div>
@endsection
