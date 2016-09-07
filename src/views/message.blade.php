@if (session()->has('flash_notification'))

    @if (session()->has('flash_notification.overlay'))
            @include('flash::modal', [
                'modalClass' => 'flash-modal',
                'title'      => session('flash_notification.overlay.title'),
                'body'       => session('flash_notification.overlay.message')
            ])
    @endif

    @if (session()->has('flash_notification.message'))
        @foreach(session('flash_notification.message') as $f)
                <div class="alert
                            alert-{{ $f['level'] }}
                            {{ isset($f['important']) ? 'alert-important' : '' }}"
                >
                    @if(isset($f['important']) && $f['important'])
                        <button type="button"
                                class="close"
                                data-dismiss="alert"
                                aria-hidden="true"
                        >&times;</button>
                    @endif

                    {!! $f['message'] !!}
                </div>
        @endforeach
    @endif

@endif
