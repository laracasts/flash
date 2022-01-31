<div class="alert
alert-{{ $level }}
{{ $important || $fixed ? 'alert-important' : '' }}"
     role="alert"
>
    @if (($dismissible || $important) && !$fixed)
        <button type="button"
                class="close"
                data-dismiss="alert"
                aria-hidden="true"
        >&times;</button>
    @endif

    {!! $message !!}
</div>