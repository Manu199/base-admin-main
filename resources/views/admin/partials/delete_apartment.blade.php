

<form action="{{ route($route, $element->id) }}" method="POST" id="formEliminar">
    @csrf
    @method('DELETE')

    <button class="btn btn-secondary btn-custom" type="button" onclick="confirmarEliminacion()">
        <i class="fa-solid fa-trash-can"></i>
    </button>
</form>

<script>
    function confirmarEliminacion() {
        document.getElementById('formEliminar').submit();
    }
</script>
