<!-- Messaggio -->
<div style="display:none" id="modal-confirm">
    <div class="messaggio-eliminare bg-white rounded-2">
        <p id="modal-text-message" class="text-messaggio-elimina">{{ $messagio }}</p>
        <button id="cancel" class="btn btn-elimina-appartamento">Annulla</button>
        <button id="confirm" class="btn btn-elimina-appartamento">Conferma</button>
    </div>
</div>

<script>
    // Funzione per gestire la conferma con la modal
    function confermaModale(form) {

        console.log('sono entrato');
        // Impedisci l'invio del modulo predefinito
        event.preventDefault();

        // Otteni il messaggio dalla tua modal
        var messaggio =
            "Confermare l'operazione?"; // Puoi personalizzare questo messaggio o prenderlo dinamicamente dalla tua modal

        // Mostra il messaggio nella tua modal
        document.getElementById("modal-text-message").innerHTML = messaggio;
        document.getElementById("modal-confirm").style.display = "block";

        // Assegna l'azione al bottone di conferma nella modal
        document.getElementById("confirm").onclick = function() {
            // Chiudi la modal
            document.getElementById("modal-confirm").style.display = "none";

            // Esegui l'azione di invio del modulo
            form.submit();
        };

        // Assegna l'azione al bottone di annulla nella modal
        document.getElementById("cancel").onclick = function() {
            console.log('pulsante cancella');
            // Chiudi la modal
            document.getElementById("modal-confirm").style.display = "none";
        };

        // Restituisci false per impedire l'invio del modulo predefinito
        return false;
    }
</script>
