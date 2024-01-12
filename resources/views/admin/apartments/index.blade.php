@extends('layouts.admin')

@section('content')

<style>
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
  </style>

    <div class="apartment">
        <h1>Apartments List</h1>

        {{-- <div class="d-flex flex-wrap justify-content-center">
            @foreach ($apartments as $apartment)
                <div class="card m-2" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $apartment->title }}</h5>
                        <p class="card-text"> Price</p>
                        <p class="card-text"> Tipo</p>
                        <p class="card-text"> Metri quadri</p>
                        <p class="card-text"> Numero di stanze</p>
                        <p class="card-text"> Letti</p>
                        <p class="card-text"> Bagni</p>
                    </div>
                </div>
            @endforeach
        </div> --}}

        @foreach ($apartments as $apartment)
        <div class="container mt-5">
            <div class="row p-2">
              <div class="col-md-4 mb-4">
                <div class="card">
                  <img src="https://via.placeholder.com/300" class="card-img-top" alt="Appartamento">
                  <div class="card-body">
                    <h5 class="card-title">{{ $apartment->title }}</h5>
                    <p class="card-text">Descrizione breve dell’appartamento. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <a href="#" class="btn btn-primary">Dettagli</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach

        @dump($apartments)
    </div>
@endsection
