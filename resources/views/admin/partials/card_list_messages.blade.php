<div class="card">
    <div class="card-header">
        <i class="fa-solid fa-paper-plane me-2"></i>
        Posta in arrivo

    </div>
    <div class="card-body cursor-pointer">
    @if ($messages->count())
        @foreach ($messages as $message)
            <ul class="list-group list-group-horizontal mb-1 " data-bs-toggle="modal"
                data-bs-target="#staticBackdrop{{ $message->id }}">
                <li class="list-group-item list-group-item-success single-line-ellipsis">
                    {{ $message->name }}</li>
                <li class="list-group-item single-line-ellipsis list-group-item-success">
                    {{ $message->email_sender }}</li>
                <li class="list-group-item single-line-ellipsis list-group-item-success">
                    {{ date('d/m/Y - H:i', strtotime($message->date)) }}</li>
                @if (Route::currentRouteName() === 'admin.apartments.listMessages')
                    <li class="list-group-item single-line-ellipsis list-group-item-success" style="width: {{ 100 / 2 }}%;">
                        {{ $message->apartment->title }}</li>
                @endif
            </ul>
            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop{{ $message->id }}" data-bs-backdrop="static"
                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="title d-sm-flex">
                                <div class="flex-column align-items-center">
                                    <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">
                                        {{ $message->name }}
                                    </h1>
                                    <p class="pb-0 inline-block">
                                        <i class="fa-solid fa-at"
                                        style="color: #047458"> :</i>
                                        {{ $message->email_sender }}
                                    </p>
                                </div>
                                <div class="address_date d-flex align-items-end mt-3 ms-sm-3">
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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>Nessun messaggio...</p>
    @endif
    </div>
</div>
