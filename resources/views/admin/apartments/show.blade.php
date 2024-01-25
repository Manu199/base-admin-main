@extends('layouts.admin')


@section('content')
    <div class="show-apartment">
        <h1 class="text-center mb-5">Dettaglio Appartamento</h1>
        <div class="d-flex align-items-center mb-3">
            <h3 class=" d-inline-block m-0">{{ $apartment->title }}</h3>
            <a class="btn border-black rounded rounded-5 mx-2" href="{{ route('admin.apartment.edit', $apartment) }}"><i
                    class="fa-solid fa-pen-to-square"></i></a>

            @include('admin.partials.delete_form', [
                'route' => 'admin.apartment.destroy',
                'element' => $apartment,
            ])
        </div>
        <div class="mb-3">
            <h6>{{ $apartment->address }}</h6>
        </div>

        <div class="row row-cols-1 row-cols-lg-2 ">
            {{-- Dati appartamento --}}
            <div class="col mb-4">
                <div class="position-relative overflow-hidden rounded rounded-4">
                    <img
                        onerror="this.src ='{{ asset('img/placeholder.png') }}'"
                        class="img-fluid"
                        src="{{ asset('storage/uploads/' . $apartment->image_path) }}"
                        alt="">
                    @if ($apartment->sponsors->count() && strtotime($apartment->sponsors[0]->pivot->expiration_date) >= strtotime(now()))
                        <div class="badge-sponsor-bottom-big">
                            <h6 class="text-bg-warning text-center m-0 py-1">
                                Sponsorizzato fino al:
                                {{ date('d/m/Y H:i', strtotime($apartment->sponsors[0]->pivot->expiration_date)) }}
                            </h6>
                        </div>
                    @endif
                </div>

                <p class=" mt-2 fs-6">&euro;{{ $apartment->price }},00/notte</p>

                <p>{{ $apartment->num_of_room }} stanze &middot; {{ $apartment->num_of_bed }} letti &middot;
                    {{ $apartment->num_of_bathroom }} bagni &middot;
                    {{ $apartment->square_meters }} mq</p>

                <h6 class="mt-4">SERIVIZI</h6>
                @foreach ($apartment->services as $service)
                    <span class="badge my-2 badge-custom"> {!! $service['name'] !!}</span>
                @endforeach

                <p class="mt-3 fs-6">{{ $apartment->description }}</p>
            </div>

            {{-- Message --}}
            @if ($messages->count())
                <div class="col mb-4">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa-solid fa-paper-plane me-2"></i>
                            Posta in arrivo
                        </div>
                        <div class="card-body cursor-pointer">
                            <style>
                                /* DA SISTEMARE */
                                .list-group-item {
                                    width: 50%;
                                }
                            </style>
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
                                                <div class="title">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                        {{ $message->name }}
                                                    </h1>
                                                    <div class="address_date d-flex justify-content-between ">
                                                        <p class="me-5">
                                                            <i class="fa-solid fa-at me-1"> :</i>
                                                            {{ $message->email_sender }}
                                                        </p>
                                                        <p>{{ date('d/m/Y - H:i', strtotime($message->date)) }}</p>
                                                    </div>

                                                </div>

                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
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
            @endif
        </div>

        {{-- GRAFICO VIEWS --}}
        <div class="mb-4">
            <h6 class="mt-5">GRAFICO</h6>
            <div class="w-50">
                <canvas id="myChart"></canvas>
            </div>
        </div>

        {{-- SPONSORIZZAZIONE --}}
        <div class="my-3">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed text-bg-success rounded" type="button"
                            data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                            aria-controls="flush-collapseOne">
                            Sponsorizza
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample"
                        style="">
                        <div class="container-sponsor d-md-flex justify-content-evenly">
                            @foreach ($sponsors as $sponsor)

                                <div class="mt-2 text-center">
                                    <input class="form-check-input" @if ($sponsor->id === 1) checked @endif
                                        type="radio" name="radio-sponsor" id="{{ $sponsor->id }}" value="{{ $sponsor->price }}">
                                    <label class="form-check-label" for="{{ $sponsor->id }}">
                                        {{ $sponsor->duration }} ore / {{ $sponsor->price }} &euro;
                                    </label>
                                </div>

                            @endforeach
                        </div>
                        <div id="dropin-container"></div>
                        <button class="btn btn-success" id="submit-button">Conferma</button>
                        <button class="btn d-none" id="loading-button" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                          </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- BUTTON LOADING --}}
    <script>
        document.getElementById('submit-button').addEventListener('click', function() {
          document.getElementById('submit-button').classList.add('d-none');
          document.getElementById('loading-button').classList.remove('d-none');

          setTimeout(function() {
            document.getElementById('loading-button').classList.add('d-none');
            document.getElementById('submit-button').classList.remove('d-none');
          }, 3000);
        });
    </script>


    {{-- Modal delete apartment --}}
    @include('admin.partials.form_elimina', [
        'messagio' => 'Vuoi eliminare questo appartamento?',
    ])

    {{-- BRAINTREE  --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script>

    <script>
        const button = document.querySelector('#submit-button');
        braintree.dropin.create({
            authorization: "{{ Braintree\ClientToken::generate() }}",
            container: '#dropin-container'
        }, function(createErr, instance) {
            button.addEventListener('click', function() {
                // all click del bottone di conferma pagamento
                // devo controllare se l'appartamento è visibile o meno
                const visible = {{ $apartment?->visible }};

                if (!visible) {
                    const confirmation = confirm(
                        'L\'appartamento non è visibile, sei sicuro di volerlo sponsorizzare?');
                    if (!confirmation) {
                        return
                    }
                }

                instance.requestPaymentMethod(function(err, payload) {

                    const selectedAmount = document.querySelector(
                        'input[name="radio-sponsor"]:checked');
                    if (selectedAmount) {
                        const amount = selectedAmount.value;
                        const idSponsor = selectedAmount.id;
                        const idApartment = {{ $apartment->id }};


                        $.get('{{ route('admin.payment.process') }}', {
                            payload: payload,
                            amount: amount, // Aggiungi l'importo alla richiesta
                            idSponsor: idSponsor,
                            /* mi passo idSponsor */
                            idApartment: idApartment /* mi passo idApartment */
                        }, function(response) {
                            console.log(response);
                            if (response.success) {
                                alert('Payment successfull!');
                                location.reload();
                            } else {
                                alert('Payment failed');
                            }
                        }, 'json');
                    }
                });
            });
        });
    </script>

    {{-- Chart.js  --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

        const arrayViews = @json($views);
        const labelsName = [];
        const dataArray = [];

        arrayViews.slice(1).forEach(monthViews => {
            const date = new Date(monthViews['month'] + '-01') ;

            // nome del mese abbreviato
            const nameMonth = date.toLocaleString('default', { month: 'short' });

            // Ottieni l'anno
            var year = date.getFullYear();

            labelsName.push(nameMonth + ' ' + year);
            dataArray.push(monthViews['total']);
        });

        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labelsName,
                datasets: [{
                    label: 'Views per mese',
                    data: dataArray,
                    borderWidth: 1
                }]
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
@endsection
