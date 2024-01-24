@extends('layouts.admin')

@section('content')
    <div class="create-edit-apartment">

        <form action="{{ $route }}" method="POST" id="form-create-edit" enctype="multipart/form-data">
            @csrf
            @method($method)

            <div class="position-relative">

                <h1 class="text-center">{{ $title }} Appartamento</h1>

                <div class="form-check form-switch position-absolute bottom-0 end-0">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        role="switch"
                        id="toggle-visible"
                        name="visible"

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

            <div class="row">
                <div class="col-6">
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
                    <div class="p-2 border rounded mb-3">
                        <div class="row">
                            {{-- SQUARE METERS --}}
                            <div class="col">
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
                            <div class="col">
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
                            <div class="col">
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
                            <div class="col">
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

                <div class="col-6">
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
                                    @if ($apartment->sponsors->count() && strtotime($apartment->sponsors[0]->pivot->expiration_date) >= strtotime(now()))
                                        <div class="badge-sponsor-bottom-big">
                                            <h6 class="text-bg-warning text-center m-0 py-1">
                                                Sponsorizzato fino al: {{ date('d/m/Y H:i', strtotime($apartment->sponsors[0]->pivot->expiration_date)) }}
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
                        <div class="row">
                            <div id="services-container" role="group" aria-label="Basic checkbox toggle button group">

                                @foreach ($services as $service)
                                    <input type="checkbox" class="btn-check btn-check-custom"
                                        id="btncheck{{ $service->id }}" value="{{ $service->id }}" name="services[]"
                                        {{-- $errors->count() mi restituisce quanti errori ci sono stati --}} {{-- se non ci sono errori, devo checkare solo se mi trovo nell'edit --}}
                                        @if (!$errors->count() && $apartment?->services->contains($service->id)) checked @endif {{-- se ci sono errori, devo checkare i vecchi elementi passati dall'old --}}
                                        @if ($errors->count() && in_array($service->id, old('services', []))) checked @endif>

                                    <label class="badge btn badge-custom px-3 py-1 m-1"
                                        for="{{ 'btncheck' . $service->id }}">
                                        {!! $service['name'] !!}
                                    </label>
                                @endforeach
                                <p id="services-error" class="text-danger"></p>
                                @error('services')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- BUTTON SUBMIT --}}
            <div class="d-flex justify-content-center mb-3">
                <button class="btn w-100 fs-4 btn-header-2" type="submit">Salva</button>
            </div>
        </form>
    </div>

    {{-- import js --}}
    @push('createEditClienValidateAp')
        <script src="{{ asset('js/createEditClienValidateAp.js') }}"></script>
    @endpush

    @stack('createEditClienValidateAp')


     {{-- Modal vissible when have a sponsor --}}
     @include('admin.partials.form_elimina',
     [
         'messagio' => 'Sei sponsorizzato. Vuoi davvero cambiare la visibilità dell\'appartamento?'
     ])



    <script>

        document.addEventListener('DOMContentLoaded', function() {

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
                const expiration_date = {{ strtotime($apartment?->sponsors[0]->pivot->expiration_date) }};
                const now = Math.floor(Date.now() / 1000);
                if(!switchCheckbox.checked){
                    if(expiration_date > now){
                        console.log('Sei sponsorizzato');
                        // Se sponsorizzato, chiedi conferma prima di impedire il cambio di stato della checkbox
                        const confirmation = confirm('Sei sponsorizzato. Vuoi davvero cambiare la visibilità dell\'appartamento?');

                        // Se l'utente conferma, permetti il cambio di stato, altrimenti previeniDefault
                        if (!confirmation) {
                            event.preventDefault();
                        }
                    }
                }
            });

        });
    </script>
@endsection
