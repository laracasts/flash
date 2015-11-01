@if (Session::has('flash_notification.message'))
    @if (Session::has('flash_notification.overlay'))
        @include('flash::modal', [
          'modalClass' => 'flash-modal',
          'title' => Session::get('flash_notification.title'),
          'body' => Session::get('flash_notification.message')
          ])
    @else
      <div class="container-fluid">
        <div class="row">
          <div class="text-center">
<<<<<<< HEAD

                  <?php $flash_notification_messages = Session::get('flash_notification.message');
                          $flash_notification_levels = Session::get('flash_notification.level');?>
                  @if(is_array($flash_notification_messages))
=======
            {{ Session::get('flash_notification.message') }}

                  <?php $flash_notification_messages = Session::get('flash_notification.message');
                          $flash_notification_levels = Session::get('flash_notification.level');?>
>>>>>>> 3965290a35abf5153098dcf6639c6cac82058303
                    @foreach($flash_notification_messages as $index => $flash_notification_message)
                    <div class="alert alert-{{ $flash_notification_levels[$index] }}"
                        style="border-radius:0;border-left:0;border-right:0;">
                        <button type="button" class="close"
                          data-dismiss="alert" aria-hidden="true">
                          <i class="lnr lnr-cross"></i>
                        </button>
                        {!! $flash_notification_message !!}
                    </div>
                    @endforeach
<<<<<<< HEAD
                  @else
                  foo
                      {!! Session::get('flash_notification.message') !!}
                  @endif
=======

>>>>>>> 3965290a35abf5153098dcf6639c6cac82058303


          </div>
        </div>
      </div>
    @endif
@endif

