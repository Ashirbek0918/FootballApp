@extends('dashboard.home')
@section('content')
    <div class="row">
        @foreach($pagination->items() as $team)
            <div class="col-lg-6 col-sm-12">
                <div class="brand-card m-4 shadow-1">
                    {{--                    bg-gray-500--}}
                    <div class="card-header bg-success">
                        <span class="text-white">{{ $team->name }}</span>

                    </div>
                    <div class="card-body">
                        <table class="table">

                            <thead>
                            <tr>
                                <th>{{ __('validation.attributes.fullname') }}</th>
                                <th>{{ __('form.positions.position') }}</th>
                                <th>{{ __('validation.attributes.age') }}</th>
                                <th>{{ __('validation.attributes.weight') }}</th>
                                <th>{{ __('validation.attributes.height') }}</th>
                                <th>{{ __('form.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($team->teamGamers as $teamGamer)
                                <tr>
                                    <td>{{ $teamGamer->gamer->name }}</td>
                                    <td>{{ $teamGamer->gamer->position->name}}</td>
                                    <td>{{ $teamGamer->gamer->age }}</td>
                                    <td>{{ $teamGamer->gamer->weight }}</td>
                                    <td>{{ $teamGamer->gamer->height }}</td>
                                    <td>
                                        <a href=" ">
                                            <i class="fa fa-trash-o text-danger button-2x"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="text-center mt-2  mb-4">
                            <a href="{{ route('teams.delete',[$team->id]) }}"
                               class="btn btn-outline-danger ">{{ __('form.delete') }}</a>
                            <a href="{{ route('teams.edit',[$team->id]) }}"
                               class="btn btn-info ">{{ __('form.edit') }}</a>

                        </div>
                    </div>
                </div>

            </div>
        @endforeach
        <div class="col-lg-6 col-sm-12">
            <div class="brand-card m-4 shadow-1">
                <div class="card-body">
                    <div class="text-center">
                        @if($pagination->total() ==0)
                            <p>
                                Bu kun uchu hozircha jamoalar yaratilmagan !
                            </p>
                        @endif
                        <a class="btn btn-outline-success pl-5 pr-5"
                           href="{{ route('teams.create',['day_id' => $day->id]) }}">
                            {{ __('form.add') }}
                        </a>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="card mb-5">
        <div class="card-body">
            <nav class="d-flex justify-content-between">
                <span>{{ __('form.showed') }}: <b>{{ $pagination->count() }}</b></span>
                {{ $pagination->links('pagination::bootstrap-4') }}
                <span>{{ __('form.total') }}: <b>{{ $pagination->total() }}</b></span>
            </nav>
        </div>
    </div>
@endsection

