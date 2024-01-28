@extends('layouts.admin')

@section('content')
    <div class="create-edit-apartment">

        <h1 class="text-center mb-3">{{ $title }} Appartamento</h1>
        <form action="{{ $route }}" method="POST" id="form-create-edit" enctype="multipart/form-data">
            @csrf
            @method($method)



            <div class="d-flex justify-content-end">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="toggle-visible" name="visible"
                        {{-- create first time --}}
                        @if (!$errors->count() && $apartment === null) checked @endif
                        {{-- no errori, edit --}}
                        @if (!$errors->count() && $apartment?->visible ?? false) checked @endif
                        {{-- errori, old data --}}
                        @if ($errors->count() && old('visible')) checked @endif>

                    <label class="form-check-label" for="flexSwitchCheckDefault">
                        <i id="eye-visible" class="far fa-eye"></i>
                        Visibile
                    </label>

                </div>
            </div>



            <div class="row row-cols-1 row-cols-md-2">
                <div class="col mb-3">
                    <div class="p-2 border rounded mb-3">
                        {{-- TITLE --}}
                        <div class="row">
                            <div class="form-floating mb-3">
                                <input required type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" placeholder="title"
                                    value="{{ old('title', $apartment?->title) }}">
                                <label class="left-initial" for="title">Titolo</label>
                                @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- DESCRIPTION --}}
                        <div class="row">
                            <div class="form-floating mb-3">
                                <textarea style="height:200px;" class="form-control @error('description') is-invalid @enderror" id="description"
                                    name="description" placeholder="description">{{ old('description', $apartment?->description) }}</textarea>
                                <label class="left-initial" for="description">Descrizione</label>
                                @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- PRICE --}}
                        <div class="row">
                            <div class="form-floating">
                                <input required type="number" class="form-control @error('price') is-invalid @enderror"
                                    id="price" name="price" placeholder="price"
                                    value="{{ old('price', $apartment?->price) }}">
                                <label class="left-initial" for="price">Prezzo</label>
                                @error('price')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- sezione address --}}
                    <div class="p-2 border rounded mb-3">
                        {{-- ADDRESS --}}
                        <div class="row position-relative">
                            <div class="form-floating">
                                <input required type="text" class="form-control @error('address') is-invalid @enderror"
                                    id="address" name="address" placeholder="address"
                                    value="{{ old('address', $apartment?->address) }}">
                                <label class="left-initial" for="address">Indirizzo</label>
                                @error('address')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <ul class="list-group" id="list-search">
                                {{-- list of search address --}}
                            </ul>
                        </div>

                    </div>
                    {{-- sezione numerica --}}
                    <div class="p-2 pb-0 border rounded">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4">
                            {{-- SQUARE METERS --}}
                            <div class="col mb-2">
                                <div class="form-floating">
                                    <input required type="number"
                                        class="form-control @error('square_meters') is-invalid @enderror" id="square_meters"
                                        name="square_meters" placeholder="square_meters"
                                        value="{{ old('square_meters', $apartment?->square_meters) }}">
                                    <label class="left-initial" for="square_meters">Mq</label>
                                    @error('square_meters')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- NUM of ROOM --}}
                            <div class="col mb-2">
                                <div class="form-floating">
                                    <input required type="number"
                                        class="form-control @error('num_of_room') is-invalid @enderror" id="num_of_room"
                                        name="num_of_room" placeholder="num_of_room"
                                        value="{{ old('num_of_room', $apartment?->num_of_room) }}">
                                    <label class="left-initial" for="num_of_room">Stanze</label>
                                    @error('num_of_room')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- NUM of BED --}}
                            <div class="col mb-2">
                                <div class="form-floating">
                                    <input required type="number"
                                        class="form-control @error('num_of_bed') is-invalid @enderror" id="num_of_bed"
                                        name="num_of_bed" placeholder="num_of_bed"
                                        value="{{ old('num_of_bed', $apartment?->num_of_bed) }}">
                                    <label class="left-initial" for="num_of_bed">Letti</label>
                                    @error('num_of_bed')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- NUM of BATHROOM --}}
                            <div class="col mb-2">
                                <div class="form-floating">
                                    <input required type="number"
                                        class="form-control @error('num_of_bathroom') is-invalid @enderror"
                                        id="num_of_bathroom" name="num_of_bathroom" placeholder="num_of_bathroom"
                                        value="{{ old('num_of_bathroom', $apartment?->num_of_bathroom) }}">
                                    <label class="left-initial" for="num_of_bathroom">Bagni</label>
                                    @error('num_of_bathroom')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col mb-3">
                    <div class="p-2 border rounded mb-3">
                        @php
                            $tempPath = session('tempImagePath');
                        @endphp
                        {{-- IMAGE --}}
                        <div class="row">
                            <div class="col">
                                <div class="mb-3 position-relative">
                                    <img id="image-preview" class="img-fluid rounded"
                                        onerror="this.src ='{{ asset('img/placeholder.png') }}'"
                                        src="{{ $tempPath ? asset('storage/temp/' . $tempPath) : asset('storage/uploads/' . $apartment?->image_path) }}"
                                        alt="image">
                                    @if ($apartment?->sponsors->count() && strtotime($apartment?->sponsors[0]->pivot->expiration_date) >= strtotime(now()))
                                        <div class="badge-sponsor-bottom-big">
                                            <h6 class="text-bg-warning text-center m-0 py-1">
                                                Sponsorizzato fino al:
                                                {{ date('d/m/Y H:i', strtotime($apartment->sponsors[0]->pivot->expiration_date)) }}
                                            </h6>
                                        </div>
                                    @endif
                                </div>

                                <!-- Input  nascosto per memorizzare il percorso del file -->
                                <input type="hidden" name="tempImagePath" id="hiddenFilePath"
                                    value="{{ $tempPath }}">

                                <input @if (!$apartment?->image_path) required @endif accept=".jpg, .jpeg, .png"
                                    type="file" class="form-control @error('image_path') is-invalid @enderror"
                                    id="image-input" name="image_path">
                                @error('image_path')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="p-2 border rounded mb-3">
                        {{-- SERVICES --}}
                        <div class="d-flex align-items-center justify-content-between w-100 border-bottom mb-2">
                            <h5 class="m-0 p-2">Servizi</h5>
                            <span class="d-none alert alert-danger m-0 p-1" id="services-error">Seleziona almeno un servizio</span>
                        </div>
                        <div class="position-relative" >
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-1 row-cols-lg-2 " id="services-container">
                                @foreach ($services as $service)
                                    <div class="col my-1">
                                        <div class="d-flex align-items-center">
                                            <div class="checkbox-wrapper-12">
                                                <div class="cbx">
                                                    <input
                                                        type="checkbox"
                                                        id="btncheck{{ $service->id }}"
                                                        value="{{ $service->id }}"
                                                        name="services[]"
                                                        {{-- $errors->count() mi restituisce quanti errori ci sono stati --}}
                                                        {{-- se non ci sono errori, devo checkare solo se mi trovo nell'edit --}}
                                                        @if (!$errors->count() && $apartment?->services->contains($service->id)) checked @endif
                                                        {{-- se ci sono errori, devo checkare i vecchi elementi passati dall'old --}}
                                                        @if ($errors->count() && in_array($service->id, old('services', []))) checked @endif>

                                                    <label class="form-check-label" for="{{ 'btncheck' . $service->id }}"></label>
                                                    <svg width="15" height="14" viewbox="0 0 15 14" fill="none">
                                                        <path d="M2 8.36364L6.23077 12L13 2"></path>
                                                    </svg>
                                                </div>
                                                <!-- Gooey-->
                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
                                                    <defs>
                                                        <filter id="goo-12">
                                                            <fegaussianblur in="SourceGraphic" stddeviation="4"
                                                                result="blur"></fegaussianblur>
                                                            <fecolormatrix in="blur" mode="matrix"
                                                                values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 22 -7"
                                                                result="goo-12"></fecolormatrix>
                                                            <feblend in="SourceGraphic" in2="goo-12"></feblend>
                                                        </filter>
                                                    </defs>
                                                </svg>
                                            </div>

                                            <label class="cursor-pointer ps-2"
                                                for="{{ 'btncheck' . $service->id }}">
                                                {!! $service['name'] !!}
                                            </label>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                            <div class="position-absolute bottom-0 end-0 cursor-pointer" id="btn-chevron">
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            @error('services')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- BUTTON SUBMIT --}}
            <div class="d-flex justify-content-center mb-3">
                <button class="btn w-100 fs-4 btn-custom-log" type="submit">Salva</button>
            </div>
        </form>
    </div>

    {{-- Modal custom toggle visible --}}
    @include('admin.partials.modal_custom', [
        'id' => 'modal-toggle-visible',
        'title' => 'Attenzione &middot; Sei sponsorizzato',
        'message' => '<p class="text-center">Vuoi davvero cambiare la visibilità dell\'appartamento?</p>',
    ])

    {{-- Validate ClienSide --}}
    @push('createEditClienValidateAp')
        <script src="{{ asset('js/createEditClienValidateAp.js') }}"></script>
    @endpush

    @stack('createEditClienValidateAp')

    {{-- Open box service --}}
    <script>
        const btnChevron = document.getElementById('btn-chevron');
        const servicesContainer = document.getElementById('services-container');
        btnChevron.addEventListener('click', function(){
            servicesContainer.classList.toggle('reset-max-height');
            btnChevron.classList.toggle('rotate-180');
        });
    </script>


    {{-- Toggle Visible --}}
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            // Importa Bootstrap

            // new modal bootstrap target
            const myModalCSM = new bootstrap.Modal('#modal-toggle-visible', {});

            const switchCheckbox = document.getElementById('toggle-visible');
            const eyeIcon = document.getElementById('eye-visible');

            // Aggiungi un listener per l'evento change sulla checkbox
            switchCheckbox.addEventListener('change', function() {
                // Verifica se la checkbox è selezionata
                eyeIcon.classList.toggle('fa-eye-slash');
                eyeIcon.classList.toggle('fa-eye');
            });

            switchCheckbox.addEventListener('click', function(event) {
                // controllo se è sponsorizzato o meno
                const expiration_date = @json(strtotime($apartment?->sponsors[0]->pivot->expiration_date ?? null));
                const now = Math.floor(Date.now() / 1000);
                if (!switchCheckbox.checked) {
                    if (expiration_date > now) {
                        console.log('Sei sponsorizzato');
                        event.preventDefault();
                        myModalCSM.show();
                    }
                }
            });

            const btnConfirm = document.getElementById('btn-confirm');
            btnConfirm.addEventListener('click', function(){
                switchCheckbox.checked = false;
                myModalCSM.hide();
            })



        });
    </script>
@endsection
