@extends('layouts.admin')


@section('content')

    <div class="show-apartment">
        <h1 class="text-center mb-3">Dettaglio Appartamento</h1>
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

        <div class="row">
            {{-- left --}}
            <div class="col">
                <div class="position-relative">
                    <img class="img-fluid" src="{{ asset('storage/uploads/' . $apartment->image_path) }}" alt="">
                    @if ($apartment->sponsors->count() && strtotime($apartment->sponsors[0]->pivot->expiration_date) >= strtotime(now()))
                        <div class="popup-container">
                            <h4 class="text-bg-danger m-0 py-2 px-3">&dollar;</h4>
                            <span class="popup-text">Sponsorizzato fino al: {{ date('d/m/Y H:i', strtotime($apartment->sponsors[0]->pivot->expiration_date)) }}</span>
                        </div>
                    @endif
                </div>

                <p>&euro;{{ $apartment->price }},00/notte</p>

                <p>{{ $apartment->num_of_room }} stanze &middot; {{ $apartment->num_of_bed }} letti &middot;
                    {{ $apartment->num_of_bathroom }} bagni &middot;
                    {{ $apartment->square_meters }} mq</p>

                <p>SERIVIZI</p>
                @foreach ($apartment->services as $service)
                    <span class="badge my-2 badge-custom"> {!! $service['name'] !!}</span>
                @endforeach

                <p>{{ $apartment->description }}</p>
            </div>

            {{-- right --}}
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa-solid fa-paper-plane me-2"></i>
                        Posta in arrivo
                    </div>
                    <div class="card-body list-message">
                        <ul class="p-0">

                            {{-- EMAIL IN ARRIVO --}}
                            <li class="mb-3 list-unstyled ">
                                <div class="list-group">
                                    <p class="list-group-item list-group-item-action list-group-item-success"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop">Tizio Caio, admin@admin.com</p>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="title">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tizio Caio</h1>
                                                <p class=" block">
                                                    <i class="fa-solid fa-at me-1"> :</i>
                                                    admin@admin.com
                                                </p>
                                                </div>

                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                This is some placeholder content to show a vertically centered modal. We've
                                                added some extra copy here to show how vertically centering the modal works when
                                                combined with scrollable modals. We also use some repeated line breaks to
                                                quickly extend the height of the content, thereby triggering the scrolling. When
                                                content becomes longer than the predefined max-height of modal, content will be
                                                cropped and scrollable within the modal.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>



                        </ul>
                    </div>
                </div>
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
                        <div class="container-sponsor d-flex justify-content-evenly">
                            @foreach ($sponsors as $sponsor)
                                <div>
                                    <input class="form-check-input" @if ($sponsor->id === 1) checked @endif
                                        type="radio" name="radio-sponsor" id="{{ $sponsor->id }}"
                                        value="{{ $sponsor->price }}">
                                    <label class="form-check-label" for="{{ $sponsor->id }}">{{ $sponsor->duration }} ore
                                        / {{ $sponsor->price }} &euro;</label>
                                </div>
                            @endforeach
                        </div>
                        <div id="dropin-container"></div>
                        <button class="btn btn-success" id="submit-button">Conferma</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal delete apartment --}}
    @include('admin.partials.delete_apartment')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script>

    <script>
        const button = document.querySelector('#submit-button');
        braintree.dropin.create({
            authorization: "{{ Braintree\ClientToken::generate() }}",
            container: '#dropin-container'
        }, function(createErr, instance) {
            button.addEventListener('click', function() {
                instance.requestPaymentMethod(function(err, payload) {

                    const selectedAmount = document.querySelector(
                        'input[name="radio-sponsor"]:checked');
                    if (selectedAmount) {
                        const amount = selectedAmount.value;
                        const idSponsor = selectedAmount.id;
                        const idApartment = @json($apartment->id);


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
@endsection
