<div class='container-sponsor d-md-flex justify-content-evenly'>
    @foreach ($sponsors as $sponsor)
        <div class='mt-2 text-center'>
            <input class='form-check-input' @if ($sponsor->id === 1) checked @endif
                type='radio' name='radio-sponsor' id='{{ $sponsor->id }}'
                value='{{ $sponsor->price }}'>
            <label class='form-check-label' for='{{ $sponsor->id }}'>
                {{ $sponsor->duration }} ore / {{ $sponsor->price }} &euro;
            </label>
        </div>
    @endforeach
</div>
<div id='dropin-container'></div>
