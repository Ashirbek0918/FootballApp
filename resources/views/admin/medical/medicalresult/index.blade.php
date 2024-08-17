@extends('dashboard.home')

@section('content')
    <div class="col-md-12 col-lg-12">
        <div class="card mb-4 shadow-1">
            <div class="card-header">
                <h4 class="card-header-title">
                    {{ __('form.medical_orders.medical_order') }}
                </h4>
            </div>
            <div class="card mb-4 shadow-1 d-flex justify-content-lg-center">
                <div class="card-body ">
                    <div class="form-row d-flex justify-content-lg-center">
                        <div class="col-md-8 mb-3">
                            <label for="content"
                                   class="form-control-label">{{ __('form.medical_orders.content') }}</label>
                            <input disabled  type="text" class="form-control"
                                   name="content" id="content" value="{{ $item->content}}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="date"
                                   class="form-control-label">{{ __('form.medical_orders.date') }}</label>
                            <input disabled type="date" value="{{ $item->date }}" class="form-control"
                                   name="date" id="date">
                        </div>
                        @if(isset($item->description))
                            <div class="col-md-12 mb-3">
                                <label class="form-control-label"
                                       for="content">{{ __('form.medical_orders.description') }}</label>
                                <textarea disabled type="text" name="description" class="form-control" id="content"  cols="30"
                                          rows="5"> {{ $item->description }}</textarea>
                            </div>
                        @endif
                        <div class="col-md-12 mb-5 mt-5">
                            @foreach($item->files as $file)
                                @include('admin.medical.medicalorder.file')
                                <span data-toggle="modal" data-target="#m_modal_{{ $file->id }}"> <i class="btn fa fa-file-pdf-o ml-3"> {{ $file->lang }} </i> </span>
                            @endforeach
                        </div>

                    </div>


                </div>

                <hr style="border: 1px solid slategray; border-radius: 2px;">
                <div class="card-body collapse show col-md-12" id="collapse1">
                    <table class="table table-responsive-sm">
                        <thead>
                        <tr>
                            <th>{{ __('validation.attributes.fullname') }}</th>
                            <th>{{ __('form.departments.department') }}</th>
                            <th>{{ __('form.positions.position') }}</th>
                            <th>{{ __('validation.attributes.passport') }}</th>
                            <th>{{ __('validation.attributes.file') }}</th>
                            <th>{{ __('form.medical.medical_results') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($employees as $employee)
                            <tr>
                                <td>{{ $employee->fullname }}</td>
                                <td>{{ $employee->department->hname}}</td>
                                <td>{{ $employee->position->hname}}</td>
                                <td>{{ $employee->passport }}</td>
                                @if(isset($employee->medicalResult))
                                    <td>
                                        @if(isset($employee->medicalResult->files))
                                            @foreach($employee->medicalResult->files as $file)

                                                @include('admin.medical.medicalresult.file')
                                                <span data-toggle="modal" data-target="#m_medicalFile_{{ $file->id }}"> <i class="btn fa fa-file-pdf-o ml-3"> {{ $file->lang }} </i> </span>
                                            @endforeach
                                        @endif
                                    </td>
                                @else
                                    <td>
                                    </td>
                                @endif
                                @if(isset($employee->medicalResult))

                                    <td>
                                        @include('admin.medical.medicalresult.show')
                                        <span data-toggle="modal" data-target="#m_medicalResultShow_{{ $employee->id }}"> <i class="btn btn-outline-primary "> {{ trans('form.show') }} </i> </span>
                                    </td>

                                @endif
                                @if(!isset($employee->medicalResult))
                                    <td>
                                                @include('admin.medical.medicalresult.create')
                                                <span data-toggle="modal" data-target="#m_medicalResult_{{ $employee->id }}"> <i class="btn btn-outline-success "> {{ trans('form.add') }} </i> </span>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        let counter = 0

        $('.special_titles_button').on('click', function (e) {
            e.preventDefault()
            counter++
            let  btn = '#'+e.target.getAttribute("data-value")
            console.log(btn)
            $(btn).append(`<div class="form-row ">
                                    <div class="col-md-6 mb-3 ">
                                        <input type="file" class="form-control" id="validationTooltip03" name="files[${counter}][file]">

                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <select name="files[${counter}][lang]" class="form-control">

                                        <option value="ru">ru</option>
                                        <option value="uz">uz</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <input name="files[${counter}][uploaded_at]" type="date" class="form-control">
                                     </div>
                                    <div class="col-md-1">
                                        <span class="btn btn-outline-danger special_titles_button_remove">-</span>
                                    </div>
                                </div>
    `)
        })
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('special_titles_button_remove')) {
                e.target.parentElement.parentElement.remove();
            }
        })
    </script>
@endsection
