@extends('dashboard.home')
@section('content')
    <div class="col-md-12 col-lg-12">
        <div class="card mb-4 shadow-1">

            <div class="card-header">
                <h4 class="card-header-title">
                    {{ __('form.game.games') }}
                </h4>
                <a href="{{ route("days.create") }}" class="btn btn-outline-success">
                    <i class="fa fa-plus button-2x"> {{ __('form.add') }}</i></a>
            </div>
            <div class="card-body collapse show" id="collapse1">
                <table class="table table-responsive-sm">
                    <thead>
                    <tr>
                        <form action="{{ route('games.index') }}">
                            <td>
                                <select class="form-control select2 select2-hidden-accessible" tabindex="-1"
                                        aria-hidden="true" id="day_id" name="day_id">
                                    <option value="" selected disabled>{{ __('form.days.day') }} {{ __('form.choose') }}</option>
                                    @foreach($days as $day)
                                        <option value="{{ $day->id }}" @selected(request('day_id') == $day->id)>{{ $day->day }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <div class="row">
                                    <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                    <a href="{{ route('games.index')}}" class="btn btn-outline-info"><i
                                            class="fa fa-refresh"></i></a>
                                </div>
                            </td>
                        </form>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>{{ __('form.game.home_team') }}</th>
                        <th>{{ __('form.game.away_team') }}</th>
                        <th>{{ __('validation.attributes.home_team_score') }}</th>
                        <th>{{ __('validation.attributes.away_team_score') }}</th>
                        <th>{{ __('form.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pagination->items() as $game)
                        <tr onclick="window.location='{{ route("games.show", [$game->id]) }}';"
                            style="cursor: pointer;">
                            <th scope="row">{{ ($pagination->currentpage()-1) * $pagination->perpage() + $loop->index + 1 }}</th>
                            <td>{{$game->homeTeam->name}}</td>
                            <td>{{$game->awayTeam->name}}</td>
                            <td>{{$game->home_team_score}}</td>
                            <td>{{$game->away_team_score}}</td>
                            <td>
                                <a href="{{ route("days.edit", [$game->id]) }}">
                                    <i class="fa fa-edit text-purple button-2x"></i></a>

                                <a href="{{ route("days.delete", [$game->id]) }}" class=""
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
