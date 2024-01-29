<!-- Modal -->
<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{!! $title !!}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! $message !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-modal" id="btn-delete" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-modal" id="btn-confirm">Conferma</button>
                <button class="btn btn-modal d-none" id="btn-spinner">
                    <span class="spinner-border spinner-border-sm"></span>
                    <span>Loading...</span>
                </button>
            </div>
        </div>
    </div>
</div>