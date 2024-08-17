@extends('dashboard.home')
@section('head')
    <style>
        input[name="passport"] {
            text-transform: uppercase;
        }
    </style>
@endsection
@section('content')
    <div class="d-flex justify-content-center mt-5">
        <div class="col-lg-12  col-md-12 ">

            <div class="card mb-4 shadow-1">
                <div class="card-body ">
                    <form action="{{ route('gamers.store') }} " method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-5 mb-3">
                                <label for="name"
                                       class="form-control-label">{{ __('validation.attributes.name') }}</label>
                                <input type="text" value="{{ old('name') }}" class="form-control"
                                       name="name" id="name" required>
                                @if($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                            <div class="col-md-5 mb-3">
                                <label for="surname"
                                       class="form-control-label">{{ __('validation.attributes.surname') }}</label>
                                <input type="text" value="{{ old('surname') }}" class="form-control"
                                       name="surname" id="surname" required>
                                @if($errors->has('surname'))
                                    <div class="text-danger">{{ $errors->first('surname') }}</div>
                                @endif
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="age"
                                       class="form-control-label">{{ __('validation.attributes.age') }}</label>
                                <input type="text" value="{{ old('age') }}" class="form-control"
                                       name="age" id="age" required>
                                @if($errors->has('age'))
                                    <div class="text-danger">{{ $errors->first('age') }}</div>
                                @endif
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="weight"
                                       class="form-control-label">{{ __('validation.attributes.weight') }}</label>
                                <input type="text" value="{{ old('weight') }}" class="form-control"
                                       name="weight" id="weight"  placeholder="kg da" >
                                @if($errors->has('weight'))
                                    <div class="text-danger">{{ $errors->first('weight') }}</div>
                                @endif
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="height"
                                       class="form-control-label">{{ __('validation.attributes.height') }}</label>
                                <input type="text" value="{{ old('height') }}" class="form-control"
                                       name="height" id="height"placeholder="cm da" >
                                @if($errors->has('height'))
                                    <div class="text-danger">{{ $errors->first('height') }}</div>
                                @endif
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="files[]"
                                       class="form-control-label">{{ __('form.files.profile') }}</label>
                                <input type="file" value="{{ old('files[]') }}" class="form-control"
                                       name="files[0][file]" id="files[]">
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
                            <div class="col-md-6 mb-3">
                                <label class="form-control-label"
                                       for="position_id">{{ __('form.positions.positions') }}</label>
                                <select class="custom-select col-md-12" name="position_id" id="position_id">
                                    <option value="" selected
                                            disabled> {{ __('form.select',['attribute' => __('form.positions.position')]) }} </option>
                                    @foreach($positions as $position)
                                        <option
                                            value="{{ $position->id }}" @selected($position->id == old('position_id'))> {{$position->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="text-center mt-3">
                                <a href="{{ route('gamers.index') }}"
                                   class="btn btn-slack col-md-2">{{{ __('form.cancel') }}}</a>
                                <button class="btn btn-info col-md-1">{{ __('form.add') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ asset('assets/plugins/formatter/jquery.formatter.min.js') }}"></script>
    <script src="{{ asset('assets/js/formatter.js') }}"></script>
@endsection
