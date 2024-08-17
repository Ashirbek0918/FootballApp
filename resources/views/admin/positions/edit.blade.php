@extends('dashboard.home')

@section('content')
    <div class="d-flex justify-content-center mt-5">
        <div class="col-lg-8 col-xlg-8 col-md-7 ">
            <div class="card mb-4 shadow-1">
                <div>
                    <form action="{{ route('positions.update',[$item->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="col-md-12 mb-4 justify-content-center">
                            <label for="content"
                                   class="form-control-label">{{ __('validation.attributes.name') }}</label>
                            <input type="text" class="form-control"
                                   name="name" id="name" value="{{ old('name',$item->name) }}">
                            @if($errors->has('name'))
                                <div class="text-danger">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="text-center mt-4">
                                <a href="{{ route('positions.index') }}"
                                   class="btn btn-slack ">{{{ __('form.cancel') }}}</a>
                                <button class="btn btn-info">{{ __('form.save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
