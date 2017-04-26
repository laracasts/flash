@if (session()->has('flash_notification.message'))
    @if (session()->has('flash_notification.overlay'))
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => session('flash_notification.title'),
            'body'       => session('flash_notification.message'),
            'msg_close'  => session('flash_notification.msg_close')
        ])
    @else
        <div class="alert
                    alert-{{ session('flash_notification.level') }}
                    {{ session()->has('flash_notification.important') ? 'alert-important' : '' }}"
        >
            @if(session()->has('flash_notification.important'))
                <button type="button"
                        class="close"
                        data-dismiss="alert"
                ><span aria-hidden="true">&times;</span></button>
            @endif

            {!! session('flash_notification.message') !!}
        </div>
    @endif
@endif
