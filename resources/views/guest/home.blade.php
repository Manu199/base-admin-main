@extends('layouts.main')

@section('content')
<div class="home">
    <h1 class="my-3 text-center ">WELCOME</h1>
    <button class=" rounded-2 px-4"><a class=" text-decoration-none text-black mt-4" href="{{route('admin.home')}}">Login</a></button>

</div>
@endsection
