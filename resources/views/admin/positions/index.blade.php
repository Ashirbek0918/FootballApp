@extends('dashboard.home')

@section('content')
    <div class="col-md-12 col-lg-12">
{{--        <div class="row mb-3">--}}
{{--            <div class="col-md-13 text-right">--}}
{{--                <a href="{{ route('positions.create') }}" class="btn btn-primary">{{ __('form.add') }}</a>--}}

{{--            </div>--}}
{{--        </div>--}}
        <div class="card mb-4 shadow-1">

            <div class="card-header">
                <h4 class="card-header-title">
                    {{ __('form.positions.positions') }}
                </h4>
                <a href="{{ route("positions.create") }}" class="btn btn-outline-success">
                    <i class="fa fa-plus button-2x"> {{ __('form.add') }}</i></a>
            </div>
            <div class="card-body collapse show" id="collapse1">
                <table class="table table-responsive-sm">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('validation.attributes.name') }}</th>
                        <th>{{ __('form.departments.department') }}</th>
                        <th>{{ __('form.employees.employees') }}</th>
                        <th>{{ __('form.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pagination->items() as $position)
                        <tr>
                            <th scope="row">{{ ($pagination->currentpage()-1) * $pagination->perpage() + $loop->index + 1 }}</th>
                            <td>{{ $position->hname }}</td>
                            <td>{{ $position->department->hname }}</td>
                            <td>{{ $position->employees}}</td>
                            <td>
                                <a href="{{ route("positions.edit", [$position->id]) }}">
                                    <i class="fa fa-edit text-purple button-2x"></i></a>

                                <a href="{{ route("positions.delete", [$position->id]) }}" class="" onclick="return confirm(this.getAttribute('data-message'));"
                                   data-message="{{ __('form.confirm_delete') }}">
                                    <i class="fa fa-trash-o text-danger button-2x"></i></a>
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

@endsection
