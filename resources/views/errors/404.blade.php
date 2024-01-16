@extends('layouts.admin')

@section('content')
<div class="pageNotFound d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 text-center">
                <h1>Errore - 404!</h1>
                <p>La pagina che cerchi non è stata trovata.</p>
                <a href="{{ route('admin.apartment.index') }}" class="btn btn-outline-primary mt-3"><i class="fa-solid fa-arrow-right-to-bracket fa-rotate-180"></i> Torna indietro</a>
            </div>
        </div>
    </div>
</div>
@endsection
