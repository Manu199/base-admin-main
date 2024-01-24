@extends('layouts.admin')


@section('content')
    <div class="messagesApartment">
        {{-- Card List Messages --}}
        @include('admin.partials.card_list_messages')
    </div>
@endsection
