@extends('dashboard.home')

@section('content')
    <div class="d-flex justify-content-center mt-5">
        <div class="col-lg-8 col-xlg-8 col-md-7 ">
            <div class="card mb-4 shadow-1">
                <div class="col-md-12 form-group">
                    <form action="{{ route('days.update',$item->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-row">
                            <div class="col-md-12 mb-4  ">
                                <label for="content"
                                       class="form-control-label">{{ __('validation.attributes.description') }}</label>
                                <input type="text" class="form-control"
                                       name="content" id="content" value="{{ old('content',$item->content) }}" required>
                                @if($errors->has('content'))
                                    <div class="text-danger">{{ $errors->first('content') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 mb-4  ">
                                <label for="time"
                                       class="form-control-label">{{ __('validation.attributes.duration') }}</label>
                                <input type="text" class="form-control"
                                       name="time" id="time" value="{{ old('time',$item->time) }}" placeholder="21:00 - 23:00">
                                @if($errors->has('time'))
                                    <div class="text-danger">{{ $errors->first('time') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 mb-4 ">
                                <label for="content"
                                       class="form-control-label">{{ __('validation.attributes.day') }}</label>
                                <input type="date" class="form-control"
                                       name="day" id="day" value="{{ old('day',$item->day) }}" required>
                                @if($errors->has('day'))
                                    <div class="text-danger">{{ $errors->first('day') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="text-center mt-4">
                                <a href="{{ route('days.index') }}"
                                   class="btn btn-slack ">{{{ __('form.cancel') }}}</a>
                                <button class="btn btn-info">{{ __('form.save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
