@if (!empty($flash_notification = session()->pull('flash_notification', '')))
    @if (!empty($flash_notification['overlay']))
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $flash_notification['title'],
            'body'       => $flash_notification['message']
        ])
    @else
        <div class="alert
                    alert-{{ $flash_notification['level'] }}
                    {{ !empty($flash_notification['important']) ? 'alert-important' : '' }}"
        >
            @if(!empty($flash_notification['important']))
                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-hidden="true"
                >&times;</button>
            @endif

            {!! $flash_notification['message'] !!}
        </div>
    @endif
@endif
