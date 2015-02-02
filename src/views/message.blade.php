@if (Session::has('flash_notification.message'))
    @if (Session::has('flash_notification.overlay'))
        @include('flash::modal', ['modalClass' => 'flash-modal', 'title' => Session::get('flash_notification.title'), 'body' => Session::get('flash_notification.message')])
    @else
        <div class="alert alert-{{ Session::get('flash_notification.level') }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            @if (count($messages=Session::get('flash_notification.message'))>0) 
            <strong>The following errors occurred:</strong>
            <ul>
              @foreach ($messages->all('<li>:message</li>') as $message)
                 {{ $message }} 
              @endforeach
            </ul>
            @else
            
            {{ Session::get('flash_notification.message') }}
            @endif
        </div>
    @endif
@endif
