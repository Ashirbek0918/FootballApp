@extends('dashboard.home')

@section('content')
    <div class="d-flex col-md-12 mt-5">
        <form action="{{ route('medical.orders.update',[$item->id]) }} " method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-lg-6  col-md-12 ">
                    <div class="card mb-4 shadow-1 d-flex justify-content-lg-center">
                        <div class="card-body ">
                            <div class="form-row d-flex justify-content-lg-center">
                                <div class="col-md-8 mb-3">
                                    <label for="content"
                                           class="form-control-label">{{ __('form.medical_orders.content') }}</label>
                                    <input type="text" class="form-control"
                                           name="content" id="content" value="{{ old('content' ,$item->content)}}">
                                    @if($errors->has('content'))
                                        <div class="text-danger">{{ $errors->first('content') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="date"
                                           class="form-control-label">{{ __('form.medical_orders.date') }}</label>
                                    {{--                                @dd($item->date)--}}
                                    <input type="date" value="{{ old('date',$item->date) }}" class="form-control"
                                           name="date" id="date">
                                    @if($errors->has('date'))
                                        <div class="text-danger">{{ $errors->first('date') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-control-label"
                                           for="content">{{ __('form.medical_orders.description') }}</label>
                                    <textarea name="description" class="form-control" id="content" cols="30"
                                              rows="5">{{ old('description',$item?->description) }}</textarea>
                                    @if($errors->has('description'))
                                        <div class="text-danger">{{ $errors->first('description') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-12 mb-5 mt-5">
                                    @foreach($item->files as $file)
                                        @include('admin.medical.medicalorder.file')
                                        {{--                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#m_modal_4">Launch Modal</button>--}}
                                        {{--                                <img src="{{ $file->path }}" alt="">--}}
                                        <span data-toggle="modal" data-target="#m_modal_{{ $file->id }}"> <i
                                                class="btn fa fa-file-pdf-o ml-3"> {{ $file->lang }} </i> </span>
                                    @endforeach
                                </div>
                                <div class="col-md-12" id="special_titles">
                                    <label for="validationTooltip03">{{ __('form.files.file') }}</label><span
                                        class="btn btn-outline-success ml-3 mb-2"
                                        id="special_titles_button"><i
                                            class="fa fa-plus-circle"></i></span>
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
                            </div>


                        </div>

                        <hr style="border: 1px solid slategray; border-radius: 2px;">
                        <div class="card-body collapse show col-md-12" id="employees-table">
                            <table class="table table-responsive-sm">
                                <thead>
                                <tr>
                                    <form action="{{ route("employees.index") }}">
                                        <td>
                                            <select
                                                class="form-control select2 select2-hidden-accessible employee-select"
                                                name="limit"
                                                style="width: 65px" id="limit">
                                                <option value="5" @selected(request('limit') == 5)>5</option>
                                                <option
                                                    value="10" @selected(request('limit') == 10 || is_null(request('limit')))>
                                                    10
                                                </option>
                                                <option value="20" @selected(request('limit') == 20)>20</option>
                                                <option value="30" @selected(request('limit') == 30)>30</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control col-md-12 employee-input"
                                                   name="fullname"
                                                   placeholder="{{ __('form.search') }}"
                                                   value="{{ request('fullname') }}">
                                        </td>
                                        <td>
                                            <select
                                                class="form-control select2 select2-hidden-accessible employee-select"
                                                tabindex="-1"
                                                aria-hidden="true" id="department_id" name="department_id">
                                                <option value=""
                                                        selected>{{ __('form.departments.departments') }} {{ __('form.choose') }}</option>
                                                @foreach($departments as $department)
                                                    <option
                                                        value="{{ $department->id }}"
                                                        @selected(request('department_id') == $department->id)
                                                    >{{ $department->hname }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select
                                                class="form-control select2 select2-hidden-accessible employee-select"
                                                tabindex="-1"
                                                aria-hidden="true" id="position_id" name="position_id">
                                                <option value=""
                                                        selected>{{ __('form.positions.positions') }} {{ __('form.choose') }}</option>
                                                @foreach($positions as $position)
                                                    <option
                                                        value="{{ $position->id }}"
                                                        @selected(request('position_id') == $position->id)
                                                    >{{ $position->hname }}</option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td>
                                            {{--                                            <div class="row">--}}
                                            {{--                                                <button class="btn btn-primary"><i class="fa fa-search"></i>--}}
                                            {{--                                                </button>--}}
                                            {{--                                                <a href="{{ route('employees.index') }}"--}}
                                            {{--                                                   class="btn btn-outline-info"><i--}}
                                            {{--                                                        class="fa fa-refresh"></i></a>--}}
                                            {{--                                            </div>--}}
                                        </td>
                                    </form>
                                </tr>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('validation.attributes.fullname') }}</th>
                                    <th>{{ __('form.departments.department') }}</th>
                                    <th>{{ __('form.positions.position') }}</th>
                                    <th>{{ __('validation.attributes.passport') }}</th>

                                </tr>
                                </thead>
                                <tbody id="employee-list">
                                @foreach($pagination->items() as $employee)
                                    <tr class="{{ $employee->id }}">
                                        {{--                                    @dd($item->order_employees)--}}
                                        <th><input class="employees"
                                                @checked(in_array($employee->id, array_column($item->order_employees, 'employee_id')))
                                                type="checkbox" name="employees[]" value="{{ $employee->id }}"></th>
                                        <td>{{ $employee->fullname }}</td>
                                        <td>{{ $employee->department->hname}}</td>
                                        <td>{{ $employee->position->hname}}</td>
                                        <td>{{ $employee->passport }}</td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <nav class="d-flex justify-content-between">
                                <span>{{ __('form.showed') }}: <b>{{ $pagination->count() }}</b></span>
                                {{ $pagination->links('pagination::bootstrap-4') }}
                                <span>{{ __('form.total') }}: <b>{{ $pagination->total() }}</b></span>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6  col-md-12 ">
                    <div class="card mt-4">
                        <div class="card-body">
                            <table class="table table-responsive-sm">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('validation.attributes.fullname') }}</th>
                                    <th>{{ __('form.departments.department') }}</th>
                                    <th>{{ __('form.positions.position') }}</th>
                                    <th>{{ __('validation.attributes.passport') }}</th>

                                </tr>
                                </thead>
                                <tbody id="employees-all">
                                @foreach($employees as $employee)
                                    <tr class="{{ $employee->id }}">
                                        {{--                                    @dd($item->order_employees)--}}
                                        <th><input checked type="checkbox" name="employees[]"
                                                   value="{{ $employee->id }}"></th>
                                        <td>{{ $employee->fullname }}</td>
                                        <td>{{ $employee->department->hname}}</td>
                                        <td>{{ $employee->position->hname}}</td>
                                        <td>{{ $employee->passport }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="text-center mt-4  mb-4">
                    <a href="{{ route('medical.orders.index') }}"
                       class="btn btn-slack col-md-2">{{{ __('form.cancel') }}}</a>
                    <button class="btn btn-info col-md-2">{{ __('form.save') }}</button>
                </div>
            </div>
        </form>

    </div>

@endsection
@section('script')
    <script>
        let counter = 0

        $('#special_titles_button').on('click', function (e) {
            e.preventDefault()
            counter++
            console.log(1)
            $('#special_titles').append(`<div class="form-row ">
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
    <script>
        let items = []

        const elements = document.getElementById('employees-all')
        elements.childNodes.forEach(function (item) {
            if (item.className) {
                items.push(item.className)
            }
        })

        console.log(items)
        $(document).on('change', '#employee-list .employees', function (e) {
            let id = e.target.getAttribute('value')
            console.log(items, id, items.includes(id))
            if (!items.includes(id)) {
                items.push(id)
                let element = e.target.parentElement.parentElement.cloneNode(true)

                $('#employees-all').append(element)
            } else {
                items.splice(items.indexOf(id), 1)
                $(`#employees-all .${id}`).remove()
            }
        })
        $(document).on('click', '.page-link', function (e) {
            e.preventDefault()
            let href = e.target.getAttribute('href')
            $.ajax({
                url: `${href}&employee=1`, // Sample API endpoint
                method: 'GET',
                // dataType: 'json',
                success: function (data) {
                    // Update the content on success
                    $("#employees-table").html(data);
                    $('.employees').get().forEach(function (item) {
                        let itemValue = item.getAttribute('value')
                        if (items.includes(itemValue)) {
                            item.checked = true
                        }
                    })
                },
                error: function (error) {
                    // Handle errors
                    console.error('Error:', error);
                }
            });
        })

        // filters
        $(document).on('change', '.employee-select', function (e) {
            e.preventDefault()
            let limit = $("#limit").val()
            let name = $(".employee-input").val()
            let department_id = $("#department_id").val()
            let position_id = $("#position_id").val()

            let path = window.location.href.split('?')[0]
            path += `?fullname=${name}&limit=${limit}&department_id=${department_id}&position_id=${position_id}`
            // console.log(path)

            console.log(name)
            $.ajax({
                url: `${path}&employee=1`, // Sample API endpoint
                method: 'GET',
                // dataType: 'json',
                success: function (data) {
                    // Update the content on success
                    $("#employees-table").html(data);
                    $('.employees').get().forEach(function (item) {
                        let itemValue = item.getAttribute('value')
                        if (items.includes(itemValue)) {
                            item.checked = true
                        }
                    })
                },
                error: function (error) {
                    // Handle errors
                    console.error('Error:', error);
                }
            });
        })
        $(document).on('input', '.employee-input', function (e) {
            e.preventDefault()
            let limit = $("#limit").val()
            let name = $(".employee-input").val()
            let department_id = $("#department_id").val()
            let position_id = $("#position_id").val()

            let path = window.location.href.split('?')[0]
            path += `?fullname=${name}&limit=${limit}&department_id=${department_id}&position_id=${position_id}`
            // console.log(path)

            $.ajax({
                url: `${path}&employee=1`, // Sample API endpoint
                method: 'GET',
                // dataType: 'json',
                success: function (data) {
                    // Update the content on success
                    $("#employees-table").html(data);
                    $('.employees').get().forEach(function (item) {
                        let itemValue = item.getAttribute('value')
                        if (items.includes(itemValue)) {
                            item.checked = true
                        }
                    })
                    const inputElement = $(".employee-input")
                    const originalValue = inputElement.val();
                    inputElement.val('');
                    inputElement.blur().focus().val(originalValue);
                },
                error: function (error) {
                    // Handle errors
                    console.error('Error:', error);
                }
            });
        })
    </script>
@endsection

