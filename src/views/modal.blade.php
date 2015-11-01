<div id="flash-overlay-modal" class="modal fade {{ $modalClass or '' }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title">{{ $title }}</h4>
            </div>

            <div class="modal-body">

                  @foreach($body as $index => $flash_notification_message)
                    <div class="alert alert-info"
                        style="border-radius:0;border-left:0;border-right:0;">
                        <button type="button" class="close"
                          data-dismiss="alert" aria-hidden="true">
                          <i class="lnr lnr-cross"></i>
                        </button>
                        {!! $flash_notification_message !!}
                    </div>
                  @endforeach

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
