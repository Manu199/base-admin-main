@extends('layouts.admin')

@section('content')
    <div class="apartment-list">
        <h1 class="text-center">I tuoi Appartamenti</h1>

        <div class="container mt-5">
            <div class="row">
                @foreach ($apartments as $apartment)
                    <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                        {{-- link alla show dell'appartamento --}}
                        <a class="text-decoration-none" href="{{ route('admin.apartment.show', $apartment) }}">
                            <div class="card">

                                <style lang="scss">
                                        .visible-badge{
                                            position: absolute;
                                            bottom: 10px;
                                            right: 10px;
                                            width: 32px;
                                            height: 32px;
                                            border-radius: 50%;
                                            display: flex;
                                            justify-content: center;
                                            align-items: center;
                                        }
                                        .sponsor-badge{
                                            position: absolute;
                                            top: 0;
                                            left: -50%;

                                            width: 100px;
                                            height: 32px;
                                            transform: translate(-50%) rotate(-45deg)
                                        }
                                </style>

                                <div class="position-relative">
                                    <img src="{{ asset('storage/uploads/' . $apartment->image_path) }}"
                                        class="card-img-top rounded rounded-4" alt="Appartamento">
                                    <div class="visible-badge text-bg-success">
                                        <i class="far {{ $apartment->visible ? 'fa-eye' : 'fa-eye-slash' }} p-1" ></i>
                                    </div>
                                    <div class="sponsor-badge text-bg-warning">
                                        ciao
                                    </div>
                                </div>

                                <div class="card-body">
                                    <h6 class="card-title single-line-ellipsis fw-bold">{{ $apartment->title }}</h6>
                                    <p class="card-text single-line-ellipsis">{{ $apartment->address }}</p>
                                    <p class="card-text">{{ $apartment->num_of_bed }} letto/i &middot;
                                        {{ $apartment->num_of_bathroom }} bagno/i &middot; {{ $apartment->square_meters }}
                                        mq</p>
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
