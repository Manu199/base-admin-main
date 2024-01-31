@extends('layouts.admin')


@section('content')
    <div class="messagesApartment">
        {{-- Card List Messages --}}
        {{-- @include('admin.partials.card_list_messages') --}}
        @if (Route::currentRouteName() === 'admin.apartments.listMessages')
        <a href="{{ route('admin.apartment.index') }}" class="btn btn-custom-index"><i
            class="fa-solid fa-arrow-right-to-bracket fa-rotate-180 fs-5"></i> Torna indietro</a>
        @else
            <a href="{{ route('admin.apartment.show', $apartment) }}" class="btn btn-custom-index"><i
                class="fa-solid fa-arrow-right-to-bracket fa-rotate-180 fs-5"></i> Torna indietro</a>
        @endif
        @include('admin.partials.box_mail')


    </div>
@endsection
