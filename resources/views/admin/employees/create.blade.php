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
                    <form action="{{ route('employees.store') }} " method="post">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-8 mb-3">
                                <label for="fullname"
                                       class="form-control-label">{{ __('validation.attributes.fullname') }}</label>
                                <input type="text" value="{{ old('fullname') }}" class="form-control"
                                       name="fullname" id="fullname">
                                @if($errors->has('fullname'))
                                    <div class="text-danger">{{ $errors->first('fullname') }}</div>
                                @endif
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="birthdate"
                                       class="form-control-label">{{ __('validation.attributes.birthdate') }}</label>
                                <input type="date" value="{{ old('birthdate') }}" class="form-control"
                                       name="birthdate" id="birthdate">
                                @if($errors->has('birthdate'))
                                    <div class="text-danger">{{ $errors->first('birthdate') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="pinfl"
                                       class="form-control-label">{{ __('validation.attributes.pinfl') }}</label>
                                <input type="text" value="{{ old('pinfl') }}" class="form-control"
                                       name="pinfl" id="pinfl">
                                @if($errors->has('pinfl'))
                                    <div class="text-danger">{{ $errors->first('pinfl') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="passport"
                                       class="form-control-label">{{ __('validation.attributes.passport') }}</label>
                                <input type="text" value="{{ old('passport') }}" class="form-control"
                                       name="passport" id="passport">
                                @if($errors->has('passport'))
                                    <div class="text-danger">{{ $errors->first('passport') }}</div>
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
                                            value="{{ $position->id }}" @selected($position->id == old('position_id'))> {{$position->hname}} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-control-label"
                                       for="inputGroupSelect01">{{ __('form.branches.branches') }}</label>
                                <select class="custom-select col-md-12" name="branch_id" id="inputGroupSelect01">
                                    <option value="" selected
                                            disabled> {{ __('form.select',['attribute' => __('form.branches.branch')]) }} </option>
                                    @foreach($branches as $branch)
                                        <option
                                            value="{{ $branch->id }}" @selected($branch->id == old('branch_id'))> {{$branch->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="text-center mt-3">
                                <a href="{{ route('employees.index') }}"
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
