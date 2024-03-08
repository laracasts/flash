@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        @if ($message['bootstrap5'])
            <div class="alert alert-{{ $message['level'] }}
            {{ $message['important'] ? 'alert-dismissible' : '' }}"
                        role="alert"
            >
            {!! $message['message'] !!}
                @if ($message['important'])
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="close"
                    ></button>
                @endif
            </div>
        @else
            <div class="alert alert-{{ $message['level'] }}
                    {{ $message['important'] ? 'alert-important' : '' }}"
            role="alert">
            @if ($message['important'])
                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-hidden="true"
                >&times;</button>
            @endif
            {!! $message['message'] !!}
            </div>
        @endif
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
