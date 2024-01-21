@extends('layouts.admin')

@section('content')
    <div class="create-edit-apartment">

        <form action="{{ $route }}" method="POST" id="form-create-edit" enctype="multipart/form-data">
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
                        <div class="row position-relative">
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
                            <div id="services-container" role="group" aria-label="Basic checkbox toggle button group">

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

    <script>
        // ------------------------------------------------------------------------------
        // IMAGE PREVIEW
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
        // AUTO COMPLETE address
        const listUl = document.getElementById('list-search');
        const addressInput = document.getElementById('address');

        let timeoutId;
        let selectedFromList = false;

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
                        selectedFromList = false;
                        listUl.innerHTML = '';
                        arrayResult = response.data.results;
                        arrayResult.forEach(element => {
                            const newli = document.createElement('li');
                            newli.innerHTML = element.address.freeformAddress;
                            newli.className = 'list-group-item list-group-item-action list-group-item-secondary cursor-pointer';

                            // Aggiungi event listener click a ciascun elemento <li>
                            newli.addEventListener('click', function () {
                                selectedFromList = true;
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

        // Svuota il dropdown quando l'utente esce dall'input
        addressInput.addEventListener('blur', function() {
            if(!selectedFromList){
                addressInput.value = arrayResult[0].address.freeformAddress;
            }
            selectedFromList = false;
            listUl.innerHTML = '';
            arrayResult = [];
        });
        // ------------------------------------------------------------------------------

        // Name
        const title = document.getElementById('title');
        title.addEventListener('input', function() {
            if (title.value.length < 8 || title.value.length > 50) {
                title.classList.add('is-invalid');
                title.classList.remove('is-valid');
                title.setCustomValidity('Inserisci un titolo con minimo 8 caratteri e massimo 50');
            } else {
                title.classList.add('is-valid');
                title.classList.remove('is-invalid');
                title.setCustomValidity('');
            }
        });

        // description
        const description = document.getElementById('description');
        description.addEventListener('input', function() {
            if (description.value.length < 15) {
                description.classList.add('is-invalid');
                description.classList.remove('is-valid');
                description.setCustomValidity('Inserisci una descrizione con almeno 15 caratteri');
            } else {
                description.classList.add('is-valid');
                description.classList.remove('is-invalid');
                description.setCustomValidity('');
            }
        });

        // price
        const price = document.getElementById('price');
        price.addEventListener('input', function() {
            if (isNaN(price.value) || parseFloat(price.value) < 1) {
                price.classList.add('is-invalid');
                price.classList.remove('is-valid');
                price.setCustomValidity('Inserisci un prezzo numerico maggiore di 1');
            } else {
                price.classList.add('is-valid');
                price.classList.remove('is-invalid');
                price.setCustomValidity('');
            }
        });

        // square_meters
        const squareMeters = document.getElementById('square_meters');
        squareMeters.addEventListener('input', function() {
            if (isNaN(squareMeters.value) || parseFloat(squareMeters.value) < 20) {
                squareMeters.classList.add('is-invalid');
                squareMeters.classList.remove('is-valid');
                squareMeters.setCustomValidity('Inserisci un valore numerico maggiore o uguale a 20 per i metri quadrati');
            } else {
                squareMeters.classList.add('is-valid');
                squareMeters.classList.remove('is-invalid');
                squareMeters.setCustomValidity('');
            }
        });

        // num_of_room, num_of_bed, num_of_bathroom
        const numericFields = ['num_of_room', 'num_of_bed', 'num_of_bathroom'];
        const nameFields = ['stanze', 'letti', 'bagni'];
        numericFields.forEach((field, index) => {
            const element = document.getElementById(field);
            element.addEventListener('input', function() {
                if (isNaN(element.value) || parseFloat(element.value) < 1) {
                    element.classList.add('is-invalid');
                    element.classList.remove('is-valid');
                    element.setCustomValidity(`Inserisci un valore numerico maggiore di 1 per ${nameFields[index]}`);
                } else {
                    element.classList.add('is-valid');
                    element.classList.remove('is-invalid');
                    element.setCustomValidity('');
                }
            });
        });


        // address
        const address = document.getElementById('address');
        address.addEventListener('input', function() {
            if (address.value.length < 5) {
                address.classList.add('is-invalid');
                address.classList.remove('is-valid');
                address.setCustomValidity('Inserisci un indirizzo con almeno 5 caratteri');
            } else {
                address.classList.add('is-valid');
                address.classList.remove('is-invalid');
                address.setCustomValidity('');
            }
        });

        // Image Path
        const imagePath = document.getElementById('image-input');
        imagePath.addEventListener('input', function() {
            const allowedExtensions = ['.jpg', '.jpeg', '.png'];
            const isValidExtension = allowedExtensions.some(ext => imagePath.value.endsWith(ext));

            if (!isValidExtension || (imagePath.hasAttribute('required') && imagePath.files.length === 0)) {
                imagePath.classList.add('is-invalid');
                imagePath.classList.remove('is-valid');
                imagePath.setCustomValidity('Inserisci un file con estensione .jpg, .jpeg o .png');
            } else {
                imagePath.classList.add('is-valid');
                imagePath.classList.remove('is-invalid');
                imagePath.setCustomValidity('');
            }
        });

        // services
        const serviceContainer = document.getElementById('services-container');
        const serviceCheckboxes = document.querySelectorAll('input[name="services[]"]');
        const serviceError = document.getElementById('services-error');

        // Aggiungo un ascoltatore per l'evento change sull'elemento contenitore dei servizi
        serviceContainer.addEventListener('change', function() {
            serviceControllerSuccess();
        });

        function serviceControllerSuccess(){
            let selectedCount = 0;

            // Ciclo tutte le checkbox dei servizi
            serviceCheckboxes.forEach(checkbox =>{
                // Se la checkbox è selezionata, incremento il contatore
                if (checkbox.checked) {
                    selectedCount++;
                }
            });

            // Verifico se almeno una checkbox è stata selezionata
            if(selectedCount < 1){
                serviceError.textContent = 'Seleziona almeno un servizio';
                return false;
            }else{
                serviceError.textContent = '';
                return true;
            }
        }

        const formCreateEdit = document.getElementById('form-create-edit');
        formCreateEdit.addEventListener('submit', function(event){
            if(!serviceControllerSuccess()){
                event.preventDefault();
            }
        })

    </script>

@endsection
