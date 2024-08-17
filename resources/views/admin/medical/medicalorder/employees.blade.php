<table class="table table-responsive-sm">
    <thead>
    <tr>
        <form action="{{ route("employees.index") }}">
            <td>
                <select class="form-control select2 select2-hidden-accessible employee-select"
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
                <input type="text" class="form-control col-md-12 employee-input" name="fullname"
                       placeholder="{{ __('form.search') }}"
                       value="{{ request('fullname') }}">
            </td>
            <td>
                <select class="form-control select2 select2-hidden-accessible employee-select"
                        tabindex="-1"
                        aria-hidden="true" id="department_id" name="department_id">
                    <option value="" selected>{{ __('form.departments.departments') }} {{ __('form.choose') }}</option>
                    @foreach($departments as $department)
                        <option
                            value="{{ $department->id }}"
                            @selected(request('department_id') == $department->id)
                        >{{ $department->hname }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select class="form-control select2 select2-hidden-accessible employee-select"
                        tabindex="-1"
                        aria-hidden="true" id="position_id" name="position_id">
                    <option value="" selected>{{ __('form.positions.positions') }} {{ __('form.choose') }}</option>
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
            <th><input type="checkbox" name="employees[]" class="employees"
                       value="{{ $employee->id }}"></th>
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
