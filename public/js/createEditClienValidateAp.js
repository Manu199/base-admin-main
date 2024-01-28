// ------------------------------------------------------------------------------
// IMAGE PREVIEW
const imageInput = document.getElementById('image-input');
imageInput.addEventListener("change", function (event) {
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

addressInput.addEventListener('input', function (event) {
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
addressInput.addEventListener('blur', function () {
    if (!selectedFromList) {
        addressInput.value = arrayResult[0].address.freeformAddress;
    }
    selectedFromList = false;
    listUl.innerHTML = '';
    arrayResult = [];
});
// ------------------------------------------------------------------------------

// Name
const title = document.getElementById('title');
title.addEventListener('input', function () {
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
description.addEventListener('input', function () {
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
price.addEventListener('input', function () {
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
squareMeters.addEventListener('input', function () {
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
    element.addEventListener('input', function () {
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
address.addEventListener('input', function () {
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
imagePath.addEventListener('input', function () {
    const allowedExtensions = ['.jpg', '.jpeg', '.png'];
    // se il mio file ha un estensione che finisce almeno con una delle estensioni permesse restituisce true
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
serviceContainer.addEventListener('change', function () {
    serviceControllerSuccess();
});

function serviceControllerSuccess() {
    let selectedCount = 0;

    // Ciclo tutte le checkbox dei servizi
    serviceCheckboxes.forEach(checkbox => {
        // Se la checkbox è selezionata, incremento il contatore
        if (checkbox.checked) {
            selectedCount++;
        }
    });

    // Verifico se almeno una checkbox è stata selezionata
    if (selectedCount < 1) {
        serviceError.classList.remove('d-none');

        return false;
    } else {
        serviceError.classList.add('d-none');
        return true;
    }
}

const formCreateEdit = document.getElementById('form-create-edit');
formCreateEdit.addEventListener('submit', function (event) {
    if (!serviceControllerSuccess()) {
        event.preventDefault();
    }
})
