@extends('dashboard.home')

@section('content')
    <div class="col-md-12 col-lg-12">

        <div class="card mb-4 shadow-1">

            <div class="card-header">
                <h4 class="card-header-title">
                    {{ __('form.medical_orders.medical_order') }}
                </h4>
                <a href="{{ route("medical.orders.create") }}" class="btn btn-outline-success">
                    <i class="fa fa-plus button-2x"> {{ __('form.add') }}</i></a>
            </div>
            <div class="card-body collapse show" id="collapse1">
                <table class="table table-responsive-sm">
                    <thead>
                    <tr>
                        <th>{{ __('form.medical_orders.content') }}</th>
                        <th>{{ __('form.medical_orders.date') }}</th>
                        <th>{{ __('form.medical_orders.description') }}</th>
                        <th>{{ __('form.employees.employees') }}</th>
                        <th>{{ __('form.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pagination->items() as $medical_order)
                        <tr>
{{--                            @dd($medical_order)--}}
                            <td><a href="{{ route('medical.orders.show', [$medical_order->id]) }}">{{ $medical_order->content }}</a></td>
                            <td>{{ $medical_order->date }}</td>
                            <td>{{ $medical_order->description }}</td>
                            <td>{{ $medical_order->order_employees_count }}</td>
                            <td>
                                <a href="{{ route("medical.orders.edit", [$medical_order->id]) }}">
                                    <i class="fa fa-edit text-purple button-2x"></i></a>
                                    <a href="{{ route("medical.orders.delete", [$medical_order->id]) }}" class=""
                                       onclick="return confirm(this.getAttribute('data-message'));"
                                       data-message="{{ __('form.confirm_delete') }}">
                                        <i class="fa fa-trash-o text-danger button-2x"></i></a>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
