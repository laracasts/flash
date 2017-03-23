@php($params = (session()->has('flash_notification.params') ? session('flash_notification.params') : [] ))

@if (session()->has('flash_notification.message'))
    @if (session()->has('flash_notification.overlay'))
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => session('flash_notification.title'),
            'body'       => session('flash_notification.message'),
            'params'     => $params
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
                        aria-hidden="true"
                >&times;</button>
            @endif

            @lang( session('flash_notification.message'), $params )
        </div>
    @endif
@endif
