@extends('layouts.admin')

@section('content')
    <div class="create-edit-apartment">
        <h1 class="text-center">{{ $title }}</h1>
        <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)

            <div class="row">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="title"  name="title" placeholder="title">
                    <label class="left-initial" for="title">Title</label>
                </div>
            </div>

            <div class="row">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="description"  name="description" placeholder="description">
                    <label class="left-initial" for="description">description</label>
                </div>
            </div>
            <div class="row">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="price"  name="price" placeholder="price">
                    <label class="left-initial" for="price">price</label>
                </div>
            </div>
            <div class="row">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="square_meters"  name="square_meters" placeholder="square_meters">
                    <label class="left-initial" for="square_meters">square_meters</label>
                </div>
            </div>
            <div class="row">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="num_of_room"  name="num_of_room" placeholder="num_of_room">
                    <label class="left-initial" for="num_of_room">num_of_room</label>
                </div>
            </div>
            <div class="row">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="num_of_bed"  name="num_of_bed" placeholder="num_of_bed">
                    <label class="left-initial" for="num_of_bed">num_of_bed</label>
                </div>
            </div>
            <div class="row">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="num_of_bathroom"  name="num_of_bathroom" placeholder="num_of_bathroom">
                    <label class="left-initial" for="num_of_bathroom">num_of_bathroom</label>
                </div>
            </div>
            <div class="row">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="country"  name="country" placeholder="country">
                    <label class="left-initial" for="country">country</label>
                </div>
            </div>
            <div class="row">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="street_address"  name="street_address" placeholder="street_address">
                    <label class="left-initial" for="street_address">street_address and number</label>
                </div>
            </div>
            <div class="row">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="city_name"  name="city_name" placeholder="city_name">
                    <label class="left-initial" for="city_name">city_name</label>
                </div>
            </div>
            <div class="row">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="postal_code"  name="postal_code" placeholder="postal_code">
                    <label class="left-initial" for="postal_code">postal_code</label>
                </div>
            </div>
            <div class="row">
                <div class=" mb-3">
                    <div class="mb-3">
                        <label for="image" class="form-label fw-bold">Image: </label>
                            <div class="mb-3 position-relative">
                                <img
                                    id="image-preview"
                                    class="img-fluid rounded"
                                    onerror="this.src ='{{ asset('img/placeholder.png') }}'"
                                    src="{{ asset('storage/'. $apartment?->image_path ) }}"
                                    alt="">
                            </div>

                        <input onchange="previewImage(event)" type="file" class="form-control @error('image_path') is-invalid @enderror" id="image" name="image_path">
                        @error('image_path')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>



            <div class="d-flex justify-content-center">
                <button class="btn btn-secondary w-100 fs-3  btn-custom" type="submit">Salva</button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event){
            const imagePreview = document.getElementById('image-preview');
            imagePreview.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
