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

        <div class="img-messages d-flex ">
            <style>
            .tooltip-container {
                position: absolute;
                bottom: 0;
                right: 0;
            }

            .tooltip-custom {
                display: inline-block;
                cursor: pointer;
                position: relative;
            }

            .tooltip-text {
                width: 200px;
                background-color: #333;
                color: #fff;
                text-align: center;
                border-radius: 4px;
                padding: 5px;
                position: absolute;
                z-index: 1;
                bottom: 50%;
                left: 100%;
                transform: translateY(50%);
                opacity: 0;
                transition: opacity 0.3s;
            }

            .tooltip-custom:hover .tooltip-text {
                opacity: 1;
            }
        </style>

        <div class="image position-relative">
                <img class="img-fluid" src="{{ asset('storage/uploads/' . $apartment->image_path) }}" alt="">
            </div>

            <div class="card ms-5 w-50">
                <div class="card-header">
                    Messaggi in arrivo
                </div>
                <div class="card-body overflow-y-scroll">
                    <ul>
                        <li class="mb-3">
                            <h6>TIZIO CAIO</h6>
                            <p  data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Launch static backdrop modal
                              </p>

                              <!-- Modal -->
                              <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        This is some placeholder content to show a vertically centered modal. We've added some extra copy here to show how vertically centering the modal works when combined with scrollable modals. We also use some repeated line breaks to quickly extend the height of the content, thereby triggering the scrolling. When content becomes longer than the predefined max-height of modal, content will be cropped and scrollable within the modal.
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                      <button type="button" class="btn btn-primary">Understood</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </li>
                        <li class="mb-3">
                            <h6>TIZIO CAIO</h6>
                            <p>EMAIL</p>
                            <p>
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Obcaecati distinctio, reprehenderit quod ipsa esse doloremque enim, unde dolore ad voluptatum architecto iste at dicta quidem explicabo non quasi autem ipsam!
                            </p>
                        </li>
                        <li class="mb-3">
                            <h6>TIZIO CAIO</h6>
                            <p>EMAIL</p>
                            <p>
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Obcaecati distinctio, reprehenderit quod ipsa esse doloremque enim, unde dolore ad voluptatum architecto iste at dicta quidem explicabo non quasi autem ipsam!
                            </p>
                        </li>
                        <li class="mb-3">
                            <h6>TIZIO CAIO</h6>
                            <p>EMAIL</p>
                            <p>
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Obcaecati distinctio, reprehenderit quod ipsa esse doloremque enim, unde dolore ad voluptatum architecto iste at dicta quidem explicabo non quasi autem ipsam!
                            </p>
                        </li>

                    </ul>
                </div>
            </div>

            @if ($apartment->sponsors->count())
                <div class="tooltip-container">
                    <div class="tooltip-custom">
                        <h4 class="text-bg-danger m-0 py-2 px-3">&dollar;</h4>
                        <span class="tooltip-text">Sponsorizzato fino al: {{ $apartment->sponsors[0]->pivot->expiration_date }}</span>
                    </div>
                </div>
            @endif
        </div>

        {{-- <div class="image position-relative">
            <img class="img-fluid" src="{{ asset('storage/uploads/' . $apartment->image_path) }}" alt="">
            <div class="position-absolute bottom-0 end-0 py-2 px-3 text-bg-danger " data-toggle="tooltip" title="Questo è il mio tooltip su un div">
                <h4 class="m-0">&dollar;</h4>
            </div>
        </div> --}}

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
                        <button class="accordion-button collapsed text-bg-success rounded" type="button"
                            data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                            aria-controls="flush-collapseOne">
                            Sponsorizza
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample"
                        style="">
                        <div class="my-3 d-flex justify-content-evenly">
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
                            } else {
                                alert('Payment failed');
                            }
                        }, 'json');
                    }
                });
            });
        });
    </script>



    <!-- Includi jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <!-- Inizializza i tooltip utilizzando JavaScript -->
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
