@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        @include('flash::alert', [
            'level'         => $message['level'],
            'message'       => $message['message'],
            'dismissible'   => $message['dismissible'],
            'fixed'     => $message['fixed'],
            'important'     => $message['important']
        ])
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
