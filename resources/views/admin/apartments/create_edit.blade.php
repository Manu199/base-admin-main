@extends('layouts.admin')

@section('content')
    <div class="create-edit-apartment">
        <h1 class="text-center">{{ $title }}</h1>
        <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)

            {{-- TITLE --}}
            <div class="row">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="title" value="{{ old('title') }}">
                    <label class="left-initial" for="title">Title</label>
                    @error('title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- DESCRIPTION --}}
            <div class="row">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                        placeholder="description" value="{{ old('description') }}">
                    <label class="left-initial" for="description">description</label>
                    @error('description')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- PRICE --}}
            <div class="row">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="price" value="{{ old('price') }}">
                    <label class="left-initial" for="price">price</label>
                    @error('price')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            {{-- SQUARE METERS --}}
            <div class="row">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control @error('square_meters') is-invalid @enderror" id="square_meters" name="square_meters"
                        placeholder="square_meters" value="{{ old('square_meters') }}">
                    <label class="left-initial" for="square_meters">square_meters</label>
                    @error('square_meters')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- NUM of ROOM --}}
            <div class="row">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control @error('num_of_room') is-invalid @enderror" id="num_of_room" name="num_of_room"
                        placeholder="num_of_room" value="{{ old('num_of_room') }}">
                    <label class="left-initial" for="num_of_room">num_of_room</label>
                    @error('num_of_room')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- NUM of BED --}}
            <div class="row">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control @error('num_of_bed') is-invalid @enderror" id="num_of_bed" name="num_of_bed" placeholder="num_of_bed" value="{{ old('num_of_bed') }}">
                    <label class="left-initial" for="num_of_bed">num_of_bed</label>
                    @error('num_of_bed')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- NUM of BATHROOM --}}
            <div class="row">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control @error('num_of_bathroom') is-invalid @enderror" id="num_of_bathroom" name="num_of_bathroom" placeholder="num_of_bathroom" value="{{ old('num_of_bathroom') }}">
                    <label class="left-initial" for="num_of_bathroom">num_of_bathroom</label>
                    @error('num_of_bathroom')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- COUNTRY --}}
            <div class="row">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('country') is-invalid @enderror" id="country" name="country" placeholder="country" value="{{ old('country') }}">
                    <label class="left-initial" for="country">country</label>
                    @error('country')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- STREET ADDRESS --}}
            <div class="row">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('street_address') is-invalid @enderror" id="street_address" name="street_address"
                        placeholder="street_address" value="{{ old('street_address') }}">
                    <label class="left-initial" for="street_address">street_address and number</label>
                    @error('street_address')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- CITY NAME --}}
            <div class="row">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('city_name') is-invalid @enderror" id="city_name" name="city_name" placeholder="city_name" value="{{ old('city_name') }}">
                    <label class="left-initial" for="city_name">city_name</label>
                    @error('city_name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- POSTAL CODE --}}
            <div class="row">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code" name="postal_code"
                        placeholder="postal_code" value="{{ old('postal_code') }}">
                    <label class="left-initial" for="postal_code">postal_code</label>
                    @error('postal_code')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            {{-- IMAGE --}}
            <div class="row">
                <div class=" mb-3">
                    <label for="image" class="form-label fw-bold">Image: </label>
                    <div class="mb-3 position-relative">
                        <img id="image-preview" class="img-fluid rounded"
                            onerror="this.src ='{{ asset('img/placeholder.png') }}'"
                            src="{{ asset('storage/' . $apartment?->image_path) }}" alt="">
                    </div>

                    <input onchange="previewImage(event)" type="file"
                        class="form-control @error('image_path') is-invalid @enderror" id="image" name="image_path">
                    @error('image_path')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- TOOGLE VISIBLE --}}
            <div class="row">
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="visible" value="1">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Visible</label>
                    </div>
                </div>
            </div>

            {{-- BUTTON SUBMIT --}}
            <div class="row">
                <div class="mb-3">
                    <div role="group" aria-label="Basic checkbox toggle button group">
                        @foreach ($services as $service)
                            <input type="checkbox" class="btn-check" id="btncheck{{ $service->id }}" value="{{ $service->id }}" name="services[]">
                            <label class="badge btn btn-info" for="btncheck{{ $service->id }}">{{ $service->name }}</label>
                        @endforeach
                    </div>
                    @dump($services)
                </div>
            </div>





            <div class="d-flex justify-content-center">
                <button class="btn btn-secondary w-100 fs-3  btn-custom" type="submit">Salva</button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const imagePreview = document.getElementById('image-preview');
            imagePreview.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
