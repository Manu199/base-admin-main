@extends('layouts.admin')

@section('content')
    <div class="create-edit-apartment">
        <h1 class="text-center">New apartments</h1>
    </div>

    <form action="{{route('admin.apartment.store')}}" method="GET">
        @csrf

        <div class="row">
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
              </div>
              <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
              </div>


        </div>



    </form>
@endsection
