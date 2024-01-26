<!-- Messaggio -->
<div class="d-none" id="modal-confirm">
    <div class="messaggio-eliminare bg-white rounded-2">
        <p id="modal-text-message" class="text-messaggio-elimina">{{ $messagio }}</p>
        <button id="cancel" class="btn btn-elimina-appartamento">Annulla</button>
        <button id="confirm" class="btn btn-elimina-appartamento">Conferma</button>
    </div>
</div>

<script>
    modalConfirm = document.getElementById('modal-confirm');
    // Funzione per gestire la conferma con la modal
    function confirmCustom(form) {
        // Impedisci l'invio del modulo predefinito
        event.preventDefault();
        modalConfirm.classList.toggle('d-none')

        // Assegna l'azione al bottone di conferma nella modal
        document.getElementById("confirm").onclick = function() {
            modalConfirm.classList.toggle('d-none')
            form.submit();
        };

        // Assegna l'azione al bottone di annulla nella modal
        document.getElementById("cancel").onclick = function() {
            modalConfirm.classList.toggle('d-none')
        };

        // Restituisci false per impedire l'invio del modulo predefinito
        return false;
    }
</script>
