@extends('layouts.admin')


@section('content')
    <div class="show-apartment">
        <h1 class="text-center mb-5">Dettaglio Appartamento</h1>
        <div class="d-flex align-items-center mb-3">
            <h3 class=" d-inline-block m-0">{{ $apartment->title }}</h3>
            <a class="btn border-black rounded rounded-5 mx-2" href="{{ route('admin.apartment.edit', $apartment) }}">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>

            @include('admin.partials.delete_form', [
                'route' => 'admin.apartment.destroy',
                'element' => $apartment,
            ])
            <button class="btn border-black rounded rounded-5 mx-2" id="btn-pay-sponsor">
                <i class="far fa-credit-card"></i>
            </button>
        </div>
        <div class="mb-3">
            <h6>{{ $apartment->address }}</h6>
        </div>

        {{-- left col --}}

        <div class="row row-cols-1 row-cols-lg-2 ">
            {{-- Dati appartamento --}}
            <div class="col mb-4">
                <div class="position-relative overflow-hidden rounded rounded-4">
                    <img onerror="this.src ='{{ asset('img/placeholder.png') }}'" class="img-fluid"
                        src="{{ asset('storage/uploads/' . $apartment->image_path) }}" alt="">
                    @if ($apartment->sponsors->count() && strtotime($apartment->sponsors[0]->pivot->expiration_date) >= strtotime(now()))
                        <div class="badge-sponsor-bottom-big">
                            <h6 class="text-bg-warning text-center m-0 py-1">
                                Sponsorizzato fino al:
                                {{ date('d/m/Y H:i', strtotime($apartment->sponsors[0]->pivot->expiration_date)) }}
                            </h6>
                        </div>
                    @endif

                </div>

                {{-- info apartment --}}
                <div class="div border rounded p-3 my-3 bg-white">
                    <div class="w-100 border-bottom mb-2">
                        <h6 class="m-0">
                            <p class="mb-2">&euro;{{ $apartment->price }},00/notte</p>
                            <p class="mb-2">{{ $apartment->num_of_room }} stanze &middot;
                                {{ $apartment->num_of_bed }} letti
                                &middot;
                                {{ $apartment->num_of_bathroom }} bagni &middot;
                                {{ $apartment->square_meters }} mq</p>
                        </h6>
                        <p class="mb-2 fs-6">{{ $apartment->description }}</p>
                    </div>

                    {{-- services --}}
                    <div class="position-relative" id="services-container">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2">
                            @foreach ($apartment->services as $service)
                                <span class="col my-2"> {!! $service['name'] !!}</span>
                            @endforeach
                        </div>
                        <div class="position-absolute bottom-0 end-0 cursor-pointer p-0" id="btn-chevron">
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </div>
                </div>
            </div>


            {{-- right col --}}
            <div class="col mb-4">

                {{-- GRAFICO VIEWS --}}
                <div class="mb-4">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa-solid fa-chart-simple  me-2"></i>
                            Statistiche:
                        </div>
                        <div class="card-body">
                            <canvas id="myChart" class="w-100 h-100"></canvas>
                        </div>
                    </div>
                </div>



                    {{-- messages --}}
                    <div class="card">
                        <div class="card-header">
                            <i class="fa-solid fa-paper-plane me-2"></i>
                            Posta in arrivo
                        </div>
                        <div class="card-body cursor-pointer">

                            @foreach ($messages as $message)
                                <ul class="list-group list-group-horizontal mb-1 " data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop{{ $message->id }}">
                                    <li class="list-group-item single-line-ellipsis list-group-item-success">
                                        {{ $message->email_sender }}</li>
                                    <li class="list-group-item single-line-ellipsis list-group-item-success">
                                        {{ date('d/m/Y - H:i', strtotime($message->date)) }}</li>
                                </ul>
                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop{{ $message->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="title d-sm-flex">
                                                    <div class="d-flex flex-column align-items-center">
                                                        <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">
                                                            {{ $message->name }}
                                                        </h1>
                                                        <p class="pb-0 inline-block">
                                                            <i class="fa-solid fa-at"
                                                            style="color: #047458"> :</i>
                                                            {{ $message->email_sender }}
                                                        </p>
                                                    </div>
                                                    <div class="address_date d-flex align-items-end mt-3 ms-4">
                                                        <p class="m-0 p-0">{{ date('d/m/Y - H:i', strtotime($message->date)) }}</p>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn-close m-0" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body mx-4">
                                                {{ $message->text }}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <p class="text-end">
                                <a href="{{ route('admin.apartment.listMessages', $apartment->id) }}"
                                    class="btn rounded-0 custom-btn-primary">Mostra tutto...</a>
                            </p>

                        </div>
                    </div>
            </div>

        </div>



        {{-- Open box service --}}
        <script>
            const btnChevron = document.getElementById('btn-chevron');
            const servicesContainer = document.getElementById('services-container');
            btnChevron.addEventListener('click', function(){
                servicesContainer.classList.toggle('reset-max-height');
                btnChevron.classList.toggle('rotate-180');
            });
        </script>

        {{-- Modal custom delete apartment --}}
        @include('admin.partials.modal_custom', [
            'id' => 'modal-delete-apartment',
            'title' => 'Attenzione',
            'message' => '<p class="text-center">Vuoi eliminare questo appartamento?</p>',
        ])

        {{-- Modal custom sponsor --}}
        @include('admin.partials.modal_custom', [
            'id' => 'modal-sponsor',
            'title' => 'Sponsorizzazione',
            'message' => view('admin.partials.sponsor', ['sponsors' => $sponsors])->render(),
        ])

        {{-- Modal custom sponsor-invisible --}}
        @include('admin.partials.modal_custom', [
            'id' => 'modal-sponsor-invisible',
            'title' => 'Attenzione &middot; Appartamento non visibile',
            'message' => '<p class="text-center">Vuoi davvero sponsorizzare l\'appartamento?</p>',
        ])

        {{-- Modal custom sponsor-success --}}
        @include('admin.partials.modal_custom', [
            'id' => 'modal-result-sponsor-success',
            'title' => 'Sponsorizzazione',
            'message' => '<p class="text-center">Pagamento effettuato con successo!</p>',
        ])
        {{-- Modal custom sponsor-failed --}}
        @include('admin.partials.modal_custom', [
            'id' => 'modal-result-sponsor-failed',
            'title' => 'Sponsorizzazione',
            'message' => '<p class="text-center">Pagamento fallito!</p>',
        ])

    </div>

    {{-- Open box service --}}
    <script>
        const btnChevron = document.getElementById('btn-chevron');
        const servicesContainer = document.getElementById('services-container');
        btnChevron.addEventListener('click', function() {
            servicesContainer.classList.toggle('reset-max-height');
            btnChevron.classList.toggle('rotate-180');
        });
    </script>


    {{-- Chart.js  --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const arrayStatistic = @json($statistic);
        const labelsName = [];
        const viewsArray = [];
        const counterMessageArray = [];

        arrayStatistic.forEach(statistic => {
            const date = new Date(statistic['month'] + '-01');
            // nome del mese abbreviato
            const nameMonth = date.toLocaleString('default', {
                month: 'short'
            });

            // Ottieni l'anno
            const year = date.getFullYear();

            labelsName.push(nameMonth + ' ' + year);
            viewsArray.push(statistic['views']);
            counterMessageArray.push(statistic['messages']);
        });

        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labelsName,
                datasets: [{
                        label: 'Views per mese',
                        data: viewsArray,
                        borderWidth: 1
                    },
                    {
                        label: 'Messaggi per mese',
                        data: counterMessageArray,
                        borderWidth: 1
                    },
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    {{-- BRAINTREE  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script>

    <script>
        // Data for sponsor
        const apartment = @json($apartment);
        const paymentProcessRoute = @json(route('admin.payment.process'));

        const btnPaySponsor = document.getElementById('btn-pay-sponsor');
        // Target modal sponsor
        const modalSponsor = new bootstrap.Modal('#modal-sponsor', {});

        btnPaySponsor.addEventListener('click', function() {
            // devo controllare se l'appartamento è visibile o meno
            const visible = apartment['visible'];

            // Target modal sponsor invisible
            const modalSponsorInvisible = new bootstrap.Modal('#modal-sponsor-invisible', {});
            if (!visible) {
                modalSponsorInvisible.show();
                // Confirm modal sponsor invisible
                const btnConfirmSponsorInvisible = document.querySelector('#modal-sponsor-invisible #btn-confirm');
                btnConfirmSponsorInvisible.addEventListener('click', function() {
                    modalSponsorInvisible.hide();
                    modalSponsor.show();
                })
            } else {
                modalSponsor.show();
            }
        })

        // Confirm modal sponsor
        const btnConfirmSponsor = document.querySelector('#modal-sponsor #btn-confirm');

        braintree.dropin.create({
            authorization: "{{ Braintree\ClientToken::generate() }}",
            container: '#dropin-container'
        }, function(createErr, instance) {
            btnConfirmSponsor.addEventListener('click', function() {
                // al click del pulsante di conferma, faccio visualizzare lo spinner
                const btnDeleteSponsor = document.querySelector('#modal-sponsor #btn-delete');
                const btnSpinnerSponsor = document.querySelector('#modal-sponsor #btn-spinner');

                btnConfirmSponsor.classList.toggle('d-none');
                btnDeleteSponsor.classList.toggle('d-none');
                btnSpinnerSponsor.classList.toggle('d-none');

                instance.requestPaymentMethod(function(err, payload) {
                    const selectedAmount = document.querySelector(
                        'input[name="radio-sponsor"]:checked');
                    if (selectedAmount) {
                        const amount = selectedAmount.value;
                        const idSponsor = selectedAmount.id;
                        const idApartment = apartment['id'];

                        $.get(paymentProcessRoute, {
                                payload: payload,
                                amount: amount, // Aggiungi l'importo alla richiesta
                                idSponsor: idSponsor,
                                /* mi passo idSponsor */
                                idApartment: idApartment,
                                /* mi passo idApartment */
                            }, function(response) {
                                btnConfirmSponsor.classList.toggle('d-none');
                                btnDeleteSponsor.classList.toggle('d-none');
                                btnSpinnerSponsor.classList.toggle('d-none');

                                console.log(response);

                                modalSponsor.hide();
                                if (response.success) {
                                    // Target modal sponsor-success
                                    const modalResultSuccess = new bootstrap.Modal(
                                        '#modal-result-sponsor-success', {});
                                    modalResultSuccess.show();
                                    const btnDeleteResultSuccess = document.querySelector(
                                        '#modal-result-sponsor-success #btn-delete');
                                    btnDeleteResultSuccess.classList.add('d-none');
                                    const btnConfirmResultSuccess = document.querySelector(
                                        '#modal-result-sponsor-success #btn-confirm');
                                    btnConfirmResultSuccess.textContent = "Ok";

                                    btnConfirmResultSuccess.addEventListener('click',
                                        function() {
                                            location.reload();
                                        })
                                } else {
                                    const modalResultFailed = new bootstrap.Modal(
                                        '#modal-result-sponsor-failed', {});
                                    modalResultFailed.show();
                                    const btnDeleteResultFailed = document.querySelector(
                                        '#modal-result-sponsor-failed #btn-delete');
                                    btnDeleteResultFailed.classList.add('d-none');
                                    const btnConfirmResultFailed = document.querySelector(
                                        '#modal-result-sponsor-failed #btn-confirm');
                                    btnConfirmResultFailed.textContent = "Ok";

                                    btnConfirmResultFailed.addEventListener('click',
                                        function() {
                                            location.reload();
                                        })

                                }
                            }, 'json')
                            .fail(function() {
                                // Questo blocco di codice verrà eseguito in caso di errore
                                btnConfirmSponsor.classList.toggle('d-none');
                                btnDeleteSponsor.classList.toggle('d-none');
                                btnSpinnerSponsor.classList.toggle('d-none');
                            })
                    };
                });
            });
        });
    </script>
@endsection
