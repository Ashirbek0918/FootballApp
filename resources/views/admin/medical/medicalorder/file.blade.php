{{--@dd($file)--}}
{{--<div class="modal" id="m_modal_{{ $file->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_4" style="display: none; padding-right: 15px;">--}}
{{--    <div class="modal-dialog modal-lg" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title" id="exampleModalLabel_4">New message</h5>--}}
{{--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                    <span aria-hidden="true"><i class="ion-ios-close-empty"></i></span>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <div class="modal-body">--}}
{{--                <embed src="{{ asset('documents/'.$file->path) }}" width="750" height="450">--}}
{{--            </div>--}}
{{--            <div class="modal-footer">--}}
{{--                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                <button type="button" class="btn btn-danger">Delete</button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<div class="modal fade" id="m_modal_{{ $file->id }}" tabindex="-1" role="dialog" style="display: none; padding-right: 15px;">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{ __('form.documents.document') }}{{" (". $file->uploaded_at.")" }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="ion-ios-close-empty"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <embed src="{{ asset('medicals/'.$file->path) }}" width="100%" height="450">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('form.close') }}</button>
                <a href="{{ asset('medicals/'.$file->path) }}" target="_blank">{{ __('form.target_blank') }}</a>
                <a href="{{ route('medical.orders.fileDelete', [$file->id]) }}" class="btn btn-danger"
                   data-message="{{ __('form.confirm_delete') }}"
                   onclick="return confirm(this.getAttribute('data-message'));"
                >{{ __('form.delete') }}</a>
                {{--                <button type="button" class="btn btn-danger">delete</button>--}}
            </div>
        </div>
    </div>
</div>
