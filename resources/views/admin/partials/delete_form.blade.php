<form
    class="d-inline-block"
    action="{{ route($route, $element) }}"
    method="POST"
    id="elimina">

    @csrf
    @method('DELETE')
    <button class="btn btn-custom " type="button" onclick="mostrareMessaggio()">
        <i class="fa-solid fa-trash-can"></i>
    </button>
</form>
