<div id="flash-overlay-modal" class="modal fade {{ $modalClass or '' }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title">@lang($title, $params)</h4>
            </div>

            <div class="modal-body">
                <p>@lang($body, $params)</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('flash::flash.closeButton')</button>
            </div>
        </div>
    </div>
</div>
