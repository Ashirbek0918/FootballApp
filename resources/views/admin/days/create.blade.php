@extends('dashboard.home')

@section('content')
    <div class="d-flex justify-content-center mt-5">
        <div class="col-lg-8 col-xlg-8 col-md-7 ">
            <div class="card mb-4 shadow-1">
                <div>
                    <form action="{{ route('days.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12 mb-4 justify-content-center ">
                            <label for="content"
                                   class="form-control-label">{{ __('validation.attributes.day') }}</label>
                            <input type="date" class="form-control"
                                   name="day" id="day" value="{{ old('day') }}">
                            @if($errors->has('day'))
                                <div class="text-danger">{{ $errors->first('day') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="text-center mt-4">
                                <a href="{{ route('days.index') }}"
                                   class="btn btn-slack ">{{{ __('form.cancel') }}}</a>
                                <button class="btn btn-info">{{ __('form.add') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
