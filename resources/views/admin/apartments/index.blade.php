@extends('layouts.admin')

@section('content')
    <div class="apartment-list">
        <h1 class="text-center">I tuoi Appartamenti</h1>

        <div class="container mt-5">
            <div class="row">
                @foreach ($apartments as $apartment)
                    <div class="col-md-4 mb-4">
                        {{-- link alla show dell'appartamento --}}
                        <a class="text-decoration-none" href="{{ route('admin.apartment.show', $apartment) }}">
                            <div class="card">
                                <img src="{{ asset('storage/uploads/' . $apartment->image_path) }}"
                                    class="card-img-top rounded rounded-4" alt="Appartamento">
                                <div class="card-body">
                                    <h6 class="card-title single-line-ellipsis fw-bold">{{ $apartment->title }}</h6>
                                    <p class="card-text single-line-ellipsis">{{ $apartment->street_address }},
                                        {{ $apartment->city_name }} - {{ $apartment->country }}</p>
                                    <p class="card-text">{{ $apartment->num_of_bed }} letto/i &middot;
                                        {{ $apartment->num_of_bathroom }} bagno/i &middot; {{ $apartment->square_meters }} mq</p>
                                    <p class="card-text fw-bold">&euro;{{ $apartment->price }}/notte</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
