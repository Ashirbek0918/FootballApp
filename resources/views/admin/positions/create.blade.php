@extends('dashboard.home')

@section('content')
    <div class="d-flex justify-content-center mt-5">
        <div class="col-lg-10 col-xlg-9 col-md-7 ">
            <div class="card mb-4 shadow-1">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">

                        <a class="nav-item nav-link  col-6" id="nav-profile-tab" data-toggle="tab" href="#my-profile"
                           role="tab" aria-controls="my-profile" aria-selected="false">{{ __('form.uz') }}</a>
                        <a class="nav-item nav-link col-6 active show" id="nav-contact-tab" data-toggle="tab" href="#my-contact"
                           role="tab"
                           aria-controls="my-contact" aria-selected="true">{{ __('form.ru') }}</a>
                    </div>
                </nav>
                <div>

                    <form action="{{ route('positions.store')}}" method="post">
                        @csrf
                        <div class="tab-content" id="pills-tabContent">

                            <div class="tab-pane fade" id="my-profile" role="tabpanel"
                                 aria-labelledby="nav-profile-tab">

                                <div class="form-group justify-content-lg-start">
                                    <label class="col-md-12 mt-3"
                                           for="name[uz]">{{ __('validation.attributes.name') }}</label>
                                    <div class="col-md-12">
                                        <input type="text" name="name[uz]" class="form-control"
                                               id="name[uz]"
                                               placeholder="{{ __('form.name_uz') }}"
                                        >
                                        @if($errors->has('name'))
                                            <div class="text-danger">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                </div>


                            </div>
                            <div class="tab-pane fade active show" id="my-contact" role="tabpanel"
                                 aria-labelledby="nav-contact-tab">
                                <div class="form-group justify-content-end">
                                    <label class="col-md-12 mt-3"
                                           for="name[ru]">{{ __('validation.attributes.name') }}</label>
                                    <div class="col-md-12">
                                        <input type="text" name="name[ru]" class="form-control" id="name[ru]"
                                               placeholder="{{ __('form.name_ru') }}" required>
                                        @if($errors->has('name'))
                                            <div class="text-danger">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            {{--                            <div class="input-group-prepend">--}}
                            <label class="form-control-label"
                                   for="inputGroupSelect01">{{ __('form.departments.departments') }}</label>
                            {{--                            </div>--}}
                            <select class="custom-select col-md-12" name="department_id" id="inputGroupSelect01">
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}"> {{$department->hname}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="text-center mt-4">
                                <a href="{{ route('positions.index') }}"
                                   class="btn btn-slack col-md-1">{{{ __('form.cancel') }}}</a>
                                <button class="btn btn-info">{{ __('form.add') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
@endsection
