@extends('layouts.admin')

@section('content')

{{-- font Figtree --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Figtree&display=swap" rel="stylesheet">

    <style>
        .apartment{
            font-family: 'Figtree', sans-serif;
        }

        .card {
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-img-top {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .card-body {
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
        }

        p{
            font-size: 12px;
            margin: 0;
        }

        .single-line-ellipsis {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis; /* Aggiunge i puntini di sospensione */
        }
    </style>

    <div class="apartment">
        <h1 class="text-center">Apartments List</h1>

        <div class="container mt-5">
            <div class="row">
                @foreach ($apartments as $apartment)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="https://via.placeholder.com/280x200" class="card-img-top rounded rounded-4" alt="Appartamento">
                            <div class="card-body">
                                <h6 class="card-title single-line-ellipsis fw-bold">{{ $apartment->title }}</h6>
                                <p class="card-text single-line-ellipsis">{{ $apartment->street_address }}, {{ $apartment->city_name }} - {{ $apartment->country }}</p>
                                <p class="card-text">{{ $apartment->num_of_bed }} bed - {{ $apartment->num_of_bathroom }} bath - {{ $apartment->square_meters }} mq</p>
                                <p class="card-text fw-bold">&euro;{{ $apartment->price }}/day</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @dump($apartments)
    </div>
@endsection
