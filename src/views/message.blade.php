@if ($flash_notification)
    @if ($flash_notification['overlay'])
        @include('flash::modal', ['modalClass' => 'flash-modal', 'title' => $flash_notification['title'], 'body' => $flash_notification['message']])
    @else
        <div class="alert alert-{{ $flash_notification['level'] }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

            {{ $flash_notification['message'] }}
        </div>
    @endif
@endif
