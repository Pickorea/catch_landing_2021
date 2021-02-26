<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="{{$id}}Title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="{{$id}}Title">{{$title}}</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body" id="{{$id}}Body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                <button style='margin-left:10px;' type="submit" class="btn btn-primary col-sm-2 float-right" id="{{$id}}Submit">{{ $actionLabel ?? __('Save') }}</button>
                <button type="button" class="btn btn-danger col-sm-2 float-right" data-dismiss="modal" id="{{$id}}Cancel">@lang('Cancel')</button>
            </div>
        </div>
    </div>
</div>
