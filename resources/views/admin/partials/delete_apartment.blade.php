
    <!-- Messaggio -->
    <div class="custom-messaggio-delete" id="mostrareMessaggio">
        <div class="messaggio-eliminare bg-white rounded-2">
            <p class="text-messaggio-elimina">Vuoi eliminare l'appartamento?</p>
            <button id="cancel" class="btn btn-elimina-appartamento">Annulla</button>
            <button id="delete-button" class="btn btn-elimina-appartamento">Conferma</button>
        </div>
    </div>




<script>

    const deleteButton = document.getElementById('delete-button');
    const cancel = document.getElementById('cancel');

    deleteButton.addEventListener("click", confirmareEliminazione);
    cancel.addEventListener("click", cancelareEliminazione);

    function mostrareMessaggio() {
        console.log('mostra messaggio');
        document.getElementById('mostrareMessaggio').style.display = 'block';
    }

    function cancelareEliminazione() {
        document.getElementById('mostrareMessaggio').style.display = 'none';
    }

    function confirmareEliminazione() {
        document.getElementById('mostrareMessaggio').style.display = 'none';
        document.getElementById('elimina').submit();
    }
</script>
