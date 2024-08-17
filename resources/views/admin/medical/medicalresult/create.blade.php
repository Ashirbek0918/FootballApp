<div class="modal fade" id="m_medicalResult_{{ $employee->id }}" tabindex="-1" role="dialog"
     style="display: none; padding-right: 15px;">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="ion-ios-close-empty"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('medical.results.store') }} " method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-row   col-md-12 mb-3">
                        <div class="col-md-4">
                            <label for="date"
                                   class="form-control-label">{{ __('validation.attributes.date') }}</label>
                            <input type="date" value="{{ old('date') }}" class="form-control"
                                   name="date" id="date">
                            @if($errors->has('date'))
                                <div class="text-danger">{{ $errors->first('date') }}</div>
                            @endif
                        </div>
                        <div class="col-md-8 ">
                            <label class="form-control-label"
                                   for="medical_status_id">{{ __('form.medical.medical_status') }}</label>
                            <select class="custom-select col-md-12" name="medical_status_id" id="medical_status_id">
                                <option value="" selected
                                        disabled> {{ __('form.select',['attribute' => __('form.medical.medical_status')]) }} </option>

                                @foreach($medicalStatuses as $medical_status)
                                    <option
                                        value="{{ $medical_status->id }}" @selected($medical_status->id == old('medical_status_id'))> {{$medical_status->hname}} </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                            <input type="hidden" name="medical_order_id" value="{{ $item->id }}">
                        </div>
                    </div>

                    <div class="col-md-12" id="special_titles_{{ $employee->id }}">
                        <label for="validationTooltip03">{{ __('form.files.file') }}</label><span
                            class="btn btn-outline-success ml-3 mb-2 special_titles_button"
                            data-value="special_titles_{{ $employee->id }}">+</span>
                        <div class="form-row ">
                            <div class="col-md-6 mb-3 ">
                                <input type="file" class="form-control" id="validationTooltip03"
                                       name="files[0][file]">
                            </div>
                            <div class="col-md-2 mb-3">
                                <select name="files[0][lang]" class="form-control">
                                    <option value="ru">ru</option>
                                    <option value="uz">uz</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <input name="files[0][uploaded_at]" type="date" class="form-control">
                            </div>
                            <div class="col-md-1">
                                <span class="btn btn-outline-danger special_titles_button_remove">-</span>
                            </div>
                            @if($errors->has('files.*'))
                                <ul>
                                    @foreach($errors->get('files.*') as $errors)
                                        @foreach($errors as $error)
                                            <div class="text-danger">
                                                {{ $error }}
                                            </div>
                                        @endforeach
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="text-center mt-4">
                            <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">{{ trans('form.cancel') }}</span>
                            </button>
                            <button class="btn btn-info">{{ __('form.add') }}</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>

</div>


