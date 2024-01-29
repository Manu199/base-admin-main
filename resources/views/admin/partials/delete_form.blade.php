<form class="d-inline-block" action="{{ route($route, $element) }}" method="POST" id="elimina"
    onsubmit="confirmCustom(event, this)">

    @csrf
    @method('DELETE')
    <button class="btn btn-custom-show-apartment" type="submit">
        <i class="fa-solid fa-trash-can"></i>
    </button>
</form>

<script>
    function confirmCustom(event, form){
        event.preventDefault();
        // new modal bootstrap target
        const modalDeleteApartment = new bootstrap.Modal('#modal-delete-apartment', {});
        modalDeleteApartment.show();

        const btnConfirm = document.querySelector('#modal-delete-apartment #btn-confirm');
        btnConfirm.addEventListener('click', function(){
            modalDeleteApartment.hide();
            form.submit();
        })
    }
</script>
