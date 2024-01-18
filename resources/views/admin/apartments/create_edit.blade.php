@extends('layouts.admin')

@section('content')
    <div class="create-edit-apartment">

        <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)

            <div class="position-relative">
                <h1 class="text-center">{{ $title }} Appartamento</h1>

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
                    <label class="form-check-label" for="flexSwitchCheckDefault">Visibile</label>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="p-2 border rounded mb-3">
                        {{-- TITLE --}}
                        <div class="row">
                            <div class="form-floating mb-3">
                                <input required
                                    type="text"
                                    class="form-control @error('title') is-invalid @enderror"
                                    id="title"
                                    name="title"
                                    placeholder="title"
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
                                <textarea
                                    style="height:200px;"
                                    class="form-control @error('description') is-invalid @enderror"
                                    id="description"
                                    name="description"
                                    placeholder="description">{{ old('description', $apartment?->description) }}</textarea>

                                <label class="left-initial" for="description">Descrizione</label>
                                @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- PRICE --}}
                        <div class="row">
                            <div class="form-floating">
                                <input required
                                    type="number"
                                    class="form-control @error('price') is-invalid @enderror"
                                    id="price"
                                    name="price"
                                    placeholder="price"
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
                        <div class="row">
                            <div class="form-floating">
                                <input required
                                    type="text"
                                    class="form-control @error('address') is-invalid @enderror"
                                    id="address"
                                    name="address"
                                    placeholder="address"
                                    value="{{ old('address', $apartment?->address) }}">
                                <label class="left-initial" for="address">Indirizzo</label>
                                @error('address')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <ul class="list-group" id="list-search">
                                    {{-- list of search address --}}
                                </ul>
                            </div>
                        </div>

                    </div>
                    {{-- sezione numerica --}}
                    <div class="p-2 border rounded mb-3">
                        <div class="row">
                            {{-- SQUARE METERS --}}
                            <div class="col">
                                <div class="form-floating">
                                    <input required
                                        type="number"
                                        class="form-control @error('square_meters') is-invalid @enderror"
                                        id="square_meters"
                                        name="square_meters"
                                        placeholder="square_meters"
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
                                    <input required
                                        type="number"
                                        class="form-control @error('num_of_room') is-invalid @enderror"
                                        id="num_of_room"
                                        name="num_of_room"
                                        placeholder="num_of_room"
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
                                    <input required
                                        type="number"
                                        class="form-control @error('num_of_bed') is-invalid @enderror"
                                        id="num_of_bed"
                                        name="num_of_bed"
                                        placeholder="num_of_bed"
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
                                    <input required
                                        type="number"
                                        class="form-control @error('num_of_bathroom') is-invalid @enderror"
                                        id="num_of_bathroom"
                                        name="num_of_bathroom"
                                        placeholder="num_of_bathroom"
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
                            // dump($tempPath);
                            // dump(old());
                            // dump($errors->all());
                        @endphp
                        {{-- IMAGE --}}
                        <div class="row">
                            <div class="col">
                                <div class="mb-3 position-relative">
                                    <img
                                        id="image-preview"
                                        class="img-fluid rounded"
                                        onerror="this.src ='{{ asset('img/placeholder.png') }}'"
                                        src="{{ $tempPath ? asset('storage/temp/' . $tempPath) : asset('storage/uploads/' . $apartment?->image_path) }}"
                                        alt="image">
                                </div>

                                <!-- Input  nascosto per memorizzare il percorso del file -->
                                <input type="hidden" name="tempImagePath" id="hiddenFilePath" value="{{ $tempPath }}">

                                @dump($apartment?->image_path)
                                @dump(!$apartment?->image_path)

                                <input
                                    @if (!$apartment?->image_path) required @endif
                                    accept=".jpg, .jpeg, .png"
                                    type="file"
                                    class="form-control @error('image_path') is-invalid @enderror"
                                    id="image-input"
                                    name="image_path">
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

    {{-- import axios cdn --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script> --}}
    <script>
        // ------------------------------------------------------------------------------
        const imageInput = document.getElementById('image-input');
        imageInput.addEventListener("change", function(event) {
            previewImage(event);
        });

        function previewImage(event) {
            const imagePreview = document.getElementById('image-preview');
            path = URL.createObjectURL(event.target.files[0]);
            imagePreview.src = path;
        }
        // ------------------------------------------------------------------------------

        const listUl = document.getElementById('list-search');
        const addressInput = document.getElementById('address');

        let timeoutId;

        addressInput.addEventListener('input', function(event) {
            // Cancella il timer precedente se esiste
            clearTimeout(timeoutId);

            // Ottieni il valore attuale dell'input
            const inputValue = event.target.value;

            // Verifica se l'input è vuoto
            if (!inputValue.trim()) {
                // Se l'input è vuoto, non effettuare la chiamata
                listUl.innerHTML = '';
                return;
            }

            const apiUrl = 'https://api.tomtom.com/search/2/geocode/';
            const apiQuery = inputValue + '.json';
            const encodedAddress = encodeURIComponent(apiQuery);
            const apiKey = '?limit=5&key=JFycdOFju9JHTRcWGALUGaqq5FULPTe8';

            const endpoint = apiUrl + encodedAddress + apiKey;

            // Imposta un timer per ritardare la chiamata di 300ms
            timeoutId = setTimeout(() => {
                // Fai la chiamata solo dopo che il timer è scaduto
                axios.get(endpoint)
                    .then(response => {
                        listUl.innerHTML = '';
                        arrayResult = response.data.results;
                        console.log(arrayResult);
                        arrayResult.forEach(element => {
                            const newli = document.createElement('li');
                            newli.innerHTML = element.address.freeformAddress;
                            newli.className = 'list-group-item list-group-item-action list-group-item-secondary cursor-pointer';

                            // Aggiungi event listener click a ciascun elemento <li>
                            newli.addEventListener('click', function () {
                                // Scrivi il testo dell'elemento cliccato nell'input
                                addressInput.value = element.address.freeformAddress;
                                // Svuota la lista dopo aver selezionato un elemento
                                listUl.innerHTML = '';
                            });

                            listUl.appendChild(newli);
                        });
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }, 300);
        });

    </script>

@endsection
