@if (session()->has('flash_notification.message'))
    @if (session()->has('flash_notification.overlay'))
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => session('flash_notification.title'),
            'body'       => session('flash_notification.message')
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

			@if( session('flash_notification.message') instanceof \Illuminate\Contracts\Support\MessageBag
			&&   session('flash_notification.message')->has())
				@foreach (session('flash_notification.message')->all() as $error)
					<li> {!! $error !!} </li>
				@endforeach
			@else
				{!! session('flash_notification.message') !!}
			@endif
        </div>
    @endif
@endif
