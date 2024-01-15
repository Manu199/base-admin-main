@extends('layouts.admin')


@section('content')
    <div class="show-apartment">
        <h1 class="text-center">Apartment detail</h1>

        <div class="d-flex align-items-center">
            <h3 class=" d-inline-block">{{ $apartment->title }}</h3>
            <a class="btn btn-warning" href="{{ route('admin.apartment.edit', $apartment) }}"><i
                    class="fa-solid fa-pen-to-square"></i></a>

            @include('admin.partials.delete_form', [
                'route' => 'admin.apartment.destroy',
                'element' => $apartment,
            ])
        </div>

        <h6>{{ $apartment->street_address }}, {{ $apartment->city_name }} {{ $apartment->postal_code }} -
            {{ $apartment->country }}</h6>

        <div class="image">
            <img class="img-fluid" src="{{ asset('storage/uploads/' . $apartment->image_path) }}" alt="">
        </div>

        <p>&euro;{{ $apartment->price }},00/day</p>

        <p>{{ $apartment->num_of_room }} rooms &middot; {{ $apartment->num_of_bed }} bedrooms &middot;
            {{ $apartment->num_of_bathroom }} bathrooms &middot;
            {{ $apartment->square_meters }} mq</p>

        <p>SERIVIZI</p>

        <p>{{ $apartment->description }}</p>
    </div>
@endsection
