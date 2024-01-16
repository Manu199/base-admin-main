@extends('layouts.admin')


@section('content')
    <div class="show-apartment">
        <h1 class="text-center">Dettaglio Appartamento</h1>

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

        <p>{{ $apartment->num_of_room }} stanze &middot; {{ $apartment->num_of_bed }} letti &middot;
            {{ $apartment->num_of_bathroom }} bagni &middot;
            {{ $apartment->square_meters }} mq</p>

        <p>SERIVIZI</p>
        @foreach ($apartment->services as $service)
            <span class="badge my-2 badge-custom-show"> {!! $service['name'] !!}</span>
        @endforeach


        <p>{{ $apartment->description }}</p>
    </div>
@endsection
