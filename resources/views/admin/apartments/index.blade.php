@extends('layouts.admin')

@section('content')
    <div class="apartment-list">
        <h1 class="text-center mb-3">I tuoi Appartamenti</h1>

        <div class="row">
            @foreach ($apartments as $apartment)
                <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                    {{-- link alla show dell'appartamento --}}
                    <div>
                        <div class="card">
                            <div class="position-relative">
                                <a class="text-decoration-none" href="{{ route('admin.apartment.show', $apartment) }}">
                                    <img
                                        onerror="this.src ='{{ asset('img/placeholder.png') }}'"
                                        src="{{ asset('storage/uploads/' . $apartment->image_path) }}"
                                        class="card-img-top rounded rounded-4"
                                        alt="Appartamento">
                                </a>
                                <a
                                    href="{{ route('admin.apartment.edit-visible', $apartment) }}"
                                    class="visible-badge text-bg-success text-decoration-none"
                                    id="toggle-icon-{{ $apartment->id }}"
                                    data-visible="{{ $apartment->visible }}"
                                    data-sponsor="{{ $apartment->sponsors[0]->pivot->expiration_date ?? null }}">
                                    <i class="far {{ $apartment->visible ? 'fa-eye' : 'fa-eye-slash' }} p-1"></i>
                                </a>
                                @if ($apartment->sponsors->count() && strtotime($apartment->sponsors[0]->pivot->expiration_date) >= strtotime(now()))
                                    <div class="sponsor-badge text-bg-warning">
                                        <span>Sponsorizzato</span>
                                    </div>
                                @endif
                            </div>
                            <a class="text-decoration-none text-black" href="{{ route('admin.apartment.show', $apartment) }}">
                                <div class="card-body">
                                    <h6 class="card-title single-line-ellipsis fw-bold">{{ $apartment->title }}</h6>
                                    <p class="card-text single-line-ellipsis">{{ $apartment->address }}</p>
                                    <p class="card-text">{{ $apartment->num_of_bed }} letto/i &middot;
                                        {{ $apartment->num_of_bathroom }} bagno/i &middot; {{ $apartment->square_meters }}
                                        mq</p>
                                    <p class="card-text fw-bold">&euro;{{ $apartment->price }}/notte</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Modal custom toggle visible --}}
        @include('admin.partials.modal_custom', [
            'id' => 'modal-toggle-visible',
            'title' => 'Attenzione &middot; Appartamento sponsorizzato',
            'message' => '<p class="text-center">Vuoi davvero cambiare la visibilità dell\'appartamento?</p>',
        ])
    </div>

    <script>
        // new modal bootstrap target
        const modalToggleVisible = new bootstrap.Modal('#modal-toggle-visible', {});

        const toggleIconArray = document.querySelectorAll('[id^="toggle-icon-"]');

        toggleIconArray.forEach(toggleIcon => {
            toggleIcon.addEventListener('click', clickHandler);

            function clickHandler(event){
                event.preventDefault();

                const apartmentSponsor = toggleIcon.getAttribute('data-sponsor');
                const apartmentVisible = toggleIcon.getAttribute('data-visible');
                console.log(apartmentVisible);

                const expirationDate = new Date(apartmentSponsor);
                const now = new Date();
                console.log(expirationDate);
                console.log(now);

                if(apartmentVisible == 1 && expirationDate >= now){
                    console.log('modal avvio');
                    modalToggleVisible.show();

                    const btnConfirm = document.getElementById('btn-confirm');
                    btnConfirm.addEventListener('click', function(){
                        modalToggleVisible.hide();
                        changeVisibility();
                    })
                }else{
                    changeVisibility();
                }
            }

            function changeVisibility(){
                // Rimuovi temporaneamente l'ascoltatore click
                toggleIcon.removeEventListener('click', clickHandler);

                // Richiama manualmente l'azione predefinita del link
                toggleIcon.click();

                // Ripristina l'ascoltatore click dopo un breve ritardo
                setTimeout(function() {
                    toggleIcon.addEventListener('click', clickHandler);
                }, 100);
            }
        });
    </script>
@endsection
