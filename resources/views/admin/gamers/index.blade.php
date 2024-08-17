@extends('dashboard.home')
@section('content')
    <div class="col-md-12 col-lg-12">
        <div class="card mb-4 shadow-1">

            <div class="card-header">
                <h4 class="card-header-title">
                    {{ __('form.gamers.gamers') }}
                </h4>
                <a href="{{ route("gamers.create") }}" class="btn btn-outline-success">
                    <i class="fa fa-plus button-2x"> {{ __('form.add') }}</i></a>
            </div>
            <div class="card-body collapse show" id="collapse1">
                <table class="table table-responsive-sm">
                    <tr>
                        <th>#</th>
                        <th>{{ __('validation.attributes.name') }}</th>
                        <th>{{ __('validation.attributes.surname') }}</th>
                        <th>{{ __('form.positions.position') }}</th>
                        <th>{{ __('form.actions') }}</th>
                    </tr>
                    <tbody>
                    @foreach($pagination->items() as $gamer)
                        <tr>
                            <th scope="row">{{ ($pagination->currentpage()-1) * $pagination->perpage() + $loop->index + 1 }}</th>
                            <td><a href="{{ route('gamers.show',[$gamer->id]) }}">{{ $gamer->name }}</a></td>
                            <td>{{ $gamer->surname }}</td>
                            <td>{{ $gamer->position->name}}</td>
                            <td>
                                <a href="{{ route("gamers.edit", [$gamer->id]) }}">
                                    <i class="fa fa-edit text-purple button-2x"></i></a>

                                <a href="{{ route("gamers.delete", [$gamer->id]) }}" class=""
                                   onclick="return confirm(this.getAttribute('data-message'));"
                                   data-message="{{ __('form.confirm_delete') }}">
                                    <i class="fa fa-trash-o text-danger button-2x"></i></a>
                            </td>
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
