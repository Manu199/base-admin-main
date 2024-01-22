@extends('layouts.admin')


@section('content')
    <div class="show-apartment">
        <h1 class="text-center">Dettaglio Appartamento</h1>

        <div class="d-flex align-items-center">
            <h3 class=" d-inline-block">{{ $apartment->title }}</h3>
            <a class="btn ms-3 border-black py-1" href="{{ route('admin.apartment.edit', $apartment) }}"><i
                    class="fa-solid fa-pen-to-square"></i></a>

            @include('admin.partials.delete_form', [
                'route' => 'admin.apartment.destroy',
                'element' => $apartment,
            ])

        </div>

        <h6>{{ $apartment->address }}</h6>

        <div class="image">
            <img class="img-fluid" src="{{ asset('storage/uploads/' . $apartment->image_path) }}" alt="">
        </div>

        <p>&euro;{{ $apartment->price }},00/day</p>

        <p>{{ $apartment->num_of_room }} stanze &middot; {{ $apartment->num_of_bed }} letti &middot;
            {{ $apartment->num_of_bathroom }} bagni &middot;
            {{ $apartment->square_meters }} mq</p>

        <p>SERIVIZI</p>
        @foreach ($apartment->services as $service)
            <span class="badge my-2 badge-custom"> {!! $service['name'] !!}</span>
        @endforeach

        <p>{{ $apartment->description }}</p>

        {{-- SPONSORIZZAZIONE --}}
        <div class="my-3">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed text-bg-success rounded" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Sponsorizza
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample" style="">
                        <div class="my-3 d-flex justify-content-evenly">
                            @foreach ($sponsors as $sponsor)
                                <div>
                                    <input class="form-check-input" @if($sponsor->id === 1) checked @endif type="radio" name="radio-sponsor" id="{{ $sponsor->id }}" value="{{ $sponsor->price }}">
                                    <label class="form-check-label" for="{{ $sponsor->id }}">{{ $sponsor->duration }} ore / {{ $sponsor->price }} &euro;</label>
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
    @include('admin.partials.delete_apartment')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script>

    <script>
        const button = document.querySelector('#submit-button');

        braintree.dropin.create({
            authorization: "{{ Braintree\ClientToken::generate(); }}",
            container: '#dropin-container'
        }, function(createErr, instance) {
            button.addEventListener('click', function() {
                instance.requestPaymentMethod(function(err, payload) {

                    const selectedAmount = document.querySelector('input[name="radio-sponsor"]:checked');
                    if(selectedAmount){
                        const amount = selectedAmount.value;
                        const idSponsor = selectedAmount.id;
                        const idApartment = @json($apartment->id);


                        $.get('{{ route('admin.payment.process') }}', {
                            payload: payload,
                            amount: amount,  // Aggiungi l'importo alla richiesta
                            idSponsor: idSponsor, /* mi passo idSponsor */
                            idApartment: idApartment /* mi passo idApartment */
                        }, function(response) {
                            console.log(response);
                            if (response.success) {
                                alert('Payment successfull!');
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
