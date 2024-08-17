@extends('dashboard.home')

@section('content')
    <div class="d-flex justify-content-center mt-5">
        <div class="col-lg-10 col-xlg-9 col-md-7 ">
            <div class="card">
{{--                <div class="card-header">--}}
{{--                    {{ __('form.edit') }}--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">

                            <a class="nav-item nav-link  col-6" id="nav-profile-tab" data-toggle="tab"
                               href="#my-profile"
                               role="tab" aria-controls="my-profile" aria-selected="false">{{ __('form.uz') }}</a>
                            <a class="nav-item nav-link col-6 active show" id="nav-contact-tab" data-toggle="tab" href="#my-contact"
                               role="tab"
                               aria-controls="my-contact" aria-selected="true">{{ __('form.ru') }}</a>
                        </div>
                    </nav>
                    <form class="form-horizontal" action="{{ route('positions.update', [ $item->id])}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="tab-content mt-4 " id="pills-tabContent">

                            <div class="tab-pane fade" id="my-profile" role="tabpanel"
                                 aria-labelledby="nav-profile-tab">

                                <div class="form-group justify-content-lg-start">
                                    <label class="col-md-12" for="name[uz]">{{ __('validation.attributes.name') }}</label>
                                    <div class="col-md-12">
                                        <input type="text" name="name[uz]" class="form-control" id="name[uz]"
                                               value="{{ $item->name_uz }} "
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
                                    <label class="col-md-12" for="name[ru]">{{ __('validation.attributes.name') }}</label>
                                    <div class="col-md-12">
                                        <input type="text" name="name[ru]" class="form-control" id="name[ru]"
                                               value="{{ $item->name_ru }} ">
                                        @if($errors->has('name'))
                                            <div class="text-danger">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                       <div class="col-md-12" >
                           <div class="input-group-append mb-3 mt-4">
                               <div class="input-group-prepend">
                                   <label class="input-group-text"
                                          for="inputGroupSelect01">{{ __('form.departments.departments') }}</label>
                               </div>
                               <select class="custom-select" name="department_id" id="inputGroupSelect01">
                                   @foreach($departments as $department)
                                       <option value="{{ $department->id }}" @selected($department->id == $item->department->id  )> {{$department->hname}} </option>
                                   @endforeach
                               </select>
                           </div>
                       </div>
                        <div class="form-group">
                            <div class="text-center mt-4">
                                <a href="{{ route('positions.index') }}"
                                   class="btn btn-slack">{{{ __('form.cancel') }}}</a>
                                <button class="btn btn-info">{{ __('form.save') }}</button>
                            </div>
                        </div>
                    </form>
{{--                </div>--}}
            </div>

        </div>
@endsection
