
    <!-- Messaggio -->
    <div class=" w-100 h-100 p-3 rounded-2 position-absolute custom-messaggio-delete" id="mostrareMessaggio" style="display: none;">
        <div class="messaggio-eliminare bg-white rounded-2">
            <p class="text-messaggio-elimina">Vuoi eliminare l'appartamento?</p>
            <button class="btn btn-elimina-appartamento" onclick="cancelareEliminazione()">No</button>
            <button class="btn btn-elimina-appartamento" onclick="confirmareEliminazione()">Sí</button>

        </div>

    </div>




<script>
    function mostrareMessaggio() {
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
