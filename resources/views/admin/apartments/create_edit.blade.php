@extends('layouts.admin')

@section('content')
    <div class="create-edit-apartment">

        <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)

            <div class="position-relative">
                <h1 class="text-center">{{ $title }}</h1>

                {{-- TOOGLE VISIBLE --}}
                <div class="form-check form-switch position-absolute bottom-0 end-0">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        role="switch"
                        id="flexSwitchCheckDefault"
                        name="visible" value="1"
                        {{-- create first time --}}
                        @if (!$errors->count() && $apartment === null) checked @endif
                        {{-- no errori, edit --}}
                        @if (!$errors->count() && $apartment?->visible) checked @endif
                        {{-- errori, old data --}}
                        @if ($errors->count() && old('visible')) checked @endif>
                    <label class="form-check-label" for="flexSwitchCheckDefault">Visible</label>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="p-2 border rounded mb-3">
                        {{-- TITLE --}}
                        <div class="row">
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    class="form-control @error('title') is-invalid @enderror"
                                    id="title"
                                    name="title"
                                    placeholder="title"
                                    value="{{ old('title', $apartment?->title) }}">
                                <label class="left-initial" for="title">Title</label>
                                @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- DESCRIPTION --}}
                        <div class="row">
                            <div class="form-floating mb-3">
                                <textarea
                                    style="height:100px;"
                                    class="form-control @error('description') is-invalid @enderror"
                                    id="description"
                                    name="description"
                                    placeholder="description">{{ old('description', $apartment?->description) }}</textarea>

                                <label class="left-initial" for="description">Description</label>
                                @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- PRICE --}}
                        <div class="row">
                            <div class="form-floating">
                                <input
                                    type="number"
                                    class="form-control @error('price') is-invalid @enderror"
                                    id="price"
                                    name="price"
                                    placeholder="price"
                                    value="{{ old('price', $apartment?->price) }}">
                                <label class="left-initial" for="price">Price</label>
                                @error('price')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- sezione address --}}
                    <div class="p-2 border rounded mb-3">
                        {{-- COUNTRY --}}
                        <div class="row">
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    class="form-control @error('country') is-invalid @enderror"
                                    id="country"
                                    name="country"
                                    placeholder="country"
                                    value="{{ old('country', $apartment?->country) }}">
                                <label class="left-initial" for="country">Country</label>
                                @error('country')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- CITY NAME --}}
                        <div class="row">
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    class="form-control @error('city_name') is-invalid @enderror"
                                    id="city_name"
                                    name="city_name"
                                    placeholder="city_name"
                                    value="{{ old('city_name', $apartment?->city_name) }}">
                                <label class="left-initial" for="city_name">City</label>
                                @error('city_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- STREET ADDRESS --}}
                        <div class="row">
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    class="form-control @error('street_address') is-invalid @enderror"
                                    id="street_address"
                                    name="street_address"
                                    placeholder="street_address"
                                    value="{{ old('street_address', $apartment?->street_address) }}">
                                <label class="left-initial" for="street_address">Street Address, House number</label>
                                @error('street_address')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- POSTAL CODE --}}
                        <div class="row">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control @error('postal_code') is-invalid @enderror"
                                    id="postal_code"
                                    name="postal_code"
                                    placeholder="postal_code"
                                    value="{{ old('postal_code', $apartment?->postal_code) }}">
                                <label class="left-initial" for="postal_code">Postal Code</label>
                                @error('postal_code')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- sezione numerica --}}
                    <div class="p-2 border rounded mb-3">
                        <div class="row">
                            {{-- SQUARE METERS --}}
                            <div class="col">
                                <div class="form-floating">
                                    <input
                                        type="number"
                                        class="form-control @error('square_meters') is-invalid @enderror"
                                        id="square_meters"
                                        name="square_meters"
                                        placeholder="square_meters"
                                        value="{{ old('square_meters', $apartment?->square_meters) }}">
                                    <label class="left-initial" for="square_meters">Total Area</label>
                                    @error('square_meters')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- NUM of ROOM --}}
                            <div class="col">
                                <div class="form-floating">
                                    <input
                                        type="number"
                                        class="form-control @error('num_of_room') is-invalid @enderror"
                                        id="num_of_room"
                                        name="num_of_room"
                                        placeholder="num_of_room"
                                        value="{{ old('num_of_room', $apartment?->num_of_room) }}">
                                    <label class="left-initial" for="num_of_room">Rooms</label>
                                    @error('num_of_room')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- NUM of BED --}}
                            <div class="col">
                                <div class="form-floating">
                                    <input
                                        type="number"
                                        class="form-control @error('num_of_bed') is-invalid @enderror"
                                        id="num_of_bed"
                                        name="num_of_bed"
                                        placeholder="num_of_bed"
                                        value="{{ old('num_of_bed', $apartment?->num_of_bed) }}">
                                    <label class="left-initial" for="num_of_bed">Bed</label>
                                    @error('num_of_bed')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- NUM of BATHROOM --}}
                            <div class="col">
                                <div class="form-floating">
                                    <input
                                        type="number"
                                        class="form-control @error('num_of_bathroom') is-invalid @enderror"
                                        id="num_of_bathroom"
                                        name="num_of_bathroom"
                                        placeholder="num_of_bathroom"
                                        value="{{ old('num_of_bathroom', $apartment?->num_of_bathroom) }}">
                                    <label class="left-initial" for="num_of_bathroom">Bathrooms</label>
                                    @error('num_of_bathroom')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="p-2 border rounded mb-3">
                        {{-- IMAGE --}}
                        <div class="row">
                            <div class="col">
                                <div class="mb-3 position-relative">
                                    <img id="image-preview" class="img-fluid rounded"
                                        onerror="this.src ='{{ asset('img/placeholder.png') }}'"
                                        src="{{ asset('storage/uploads/' . $apartment?->image_path) }}" alt="image">
                                </div>

                                <input onchange="previewImage(event)" type="file"
                                    class="form-control @error('image_path') is-invalid @enderror" id="image" name="image_path">
                                @error('image_path')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="p-2 border rounded mb-3">
                        {{-- SERVICES --}}
                        <div class="row">
                            <div role="group" aria-label="Basic checkbox toggle button group">

                                @foreach ($services as $service)
                                    <input
                                        type="checkbox"
                                        class="btn-check btn-check-custom"
                                        id="btncheck{{ $service->id }}"
                                        value="{{ $service->id }}"
                                        name="services[]"
                                        {{-- $errors->count() mi restituisce quanti errori ci sono stati --}}
                                        {{-- se non ci sono errori, devo checkare solo se mi trovo nell'edit --}}
                                        @if (!$errors->count() && $apartment?->services->contains($service->id)) checked @endif
                                        {{-- se ci sono errori, devo checkare i vecchi elementi passati dall'old --}}
                                        @if ($errors->count() && in_array($service->id, old('services', []))) checked @endif>

                                    <label class="badge btn badge-custom px-3 py-1 m-1" for="{{ 'btncheck' . $service->id }}">
                                        {!! $service['name'] !!}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">

            </div>











            {{-- BUTTON SUBMIT --}}
            <div class="d-flex justify-content-center mb-3">
                <button class="btn w-100 fs-4 btn-header-2" type="submit">Salva</button>
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
