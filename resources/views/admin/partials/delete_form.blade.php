<form class="d-inline-block" action="{{ route($route, $element) }}" method="POST" id="elimina"
    onsubmit="return confirmCustom(this)">

    @csrf
    @method('DELETE')
    <button class="btn btn-custom border-black rounded rounded-5" type="submit">
        <i class="fa-solid fa-trash-can"></i>
    </button>
</form>
