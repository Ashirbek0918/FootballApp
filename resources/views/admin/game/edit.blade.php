@extends('dashboard.home')
@section('content')
    <div class="mt-5">
        <div class="text-center col-md-12">
            <p class="tx-20 text-black-50 mg-0">{{ __('form.game.game_stat') }}</p>
        </div>

        <form action="{{ route('games.update',[$item->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-md-6 mt-4">
                    <div class="card mg-b-30 shadow-1">
                        <div class="card-header">
                            <h4 class="card-header-title">
                                {{ $item->homeTeam->name }}
                            </h4>
                            <div class="col-md-2 card-header-btn text-right">
                                <input type="text" name="home_team_score" class="form-control" id="assists"
                                       value="{{ $item->home_team_score }}">
                            </div>
                        </div>
                        <div class="table-responsive collapse show" id="collapse3">
                            <table class="table card-table">
                                <thead>
                                <tr>
                                    <th>{{ __('form.gamers.gamer') }}</th>
                                    <th>{{ __('validation.attributes.goals') }}</th>
                                    <th>{{ __('validation.attributes.assists') }}</th>
                                    <th>{{ __('validation.attributes.yellow_cards') }}</th>
                                    <th>{{ __('validation.attributes.red_cards') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($item->homeTeam->teamGamers as $gamerData)
                                    <tr>
                                        <td>
                                            <div class="media">
                                                @if(!empty($gamerData->gamer->files[0]))
                                                    <img class="wd-30 img-fluid"
                                                         src="{{ Storage::url($gamerData->gamer->files[0]['path']) }}"
                                                         alt="">
                                                @else
                                                    <img class="wd-30 img-fluid"
                                                         src="{{ asset('assets/images/user/user2.png')}}" alt="">
                                                @endif
                                                <div class="media-body mg-l-10">
                                                    <p class="lh-1 mg-0">
                                                        <a href="#accordionHeaderbg1_{{$gamerData->id}}"
                                                           data-toggle="collapse"
                                                           aria-expanded="@if($errors->any()) true @else false @endif"
                                                           aria-controls="accordionHeaderbg1">
                                                            {{ $gamerData->gamer->name }}  {{ $gamerData->gamer->surname }}
                                                        </a>
                                                    </p>
                                                    <small>{{ $gamerData->gamer->position->name }}</small>
                                                </div>
                                            </div>
                                            <div id="accordionHeaderbg">
                                                <div class="card mb-2 col-md-12">
                                                    <div id="accordionHeaderbg1_{{$gamerData->id}}"
                                                         class="collapse @if($errors->any()) show @endif"
                                                         data-parent="#accordionHeaderbg" style="">
                                                        <div class="card-body">
                                                            <div>
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label
                                                                            for="goals">{{ __('validation.attributes.goals') }}</label>
                                                                        <input type="number"
                                                                               name="gamers[{{ $gamerData->id }}][goals]"
                                                                               class="form-control" id="goals"
                                                                               value="{{ old('goals.'.$gamerData->gamer->id) ?? $gamerData->gamer->gameStats[0]->goals ?? 0 }}">
                                                                    </div>
                                                                    <div class="col">
                                                                        <label
                                                                            for="assists">{{ __('validation.attributes.assists') }}</label>
                                                                        <input type="number"
                                                                               name="gamers[{{ $gamerData->id }}][assists]"
                                                                               class="form-control" id="assists"
                                                                               value="{{ old('assists.'.$gamerData->gamer->id) ?? $gamerData->gamer->gameStats[0]->assists ?? 0 }}">
                                                                    </div>
                                                                    <div class="col">
                                                                        <label
                                                                            for="yellow_cards">{{ __('validation.attributes.yellow_cards') }}</label>
                                                                        <input type="number"
                                                                               name="gamers[{{ $gamerData->id }}][yellow_cards]"
                                                                               class="form-control" id="yellow_cards"
                                                                               value="{{ old('yellow_cards.'.$gamerData->gamer->id) ?? $gamerData->gamer->gameStats[0]->yellow_cards ?? 0 }}">
                                                                    </div>
                                                                    <div class="col">
                                                                        <label
                                                                            for="red_cards">{{ __('validation.attributes.red_cards') }}</label>
                                                                        <input type="number"
                                                                               name="gamers[{{ $gamerData->id }}][red_cards]"
                                                                               class="form-control" id="red_cards"
                                                                               value="{{ old('red_cards.'.$gamerData->gamer->id) ?? $gamerData->gamer->gameStats[0]->red_cards ?? 0 }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        @if(!empty($gamerData->gamer->gameStats))
                                            <td>{{ $gamerData->gamer->gameStats[0]->goals }}</td>
                                            <td>{{ $gamerData->gamer->gameStats[0]->assists }}</td>
                                            <td>{{ $gamerData->gamer->gameStats[0]->yellow_cards }}</td>
                                            <td>{{ $gamerData->gamer->gameStats[0]->red_cards }}</td>
                                        @else
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-4">
                    <div class="card mg-b-30 shadow-1">
                        <div class="card-header">
                            <div class="col-md-2 card-header-title ">
                                <input type="text" name="away_team_score"
                                       class="form-control" id="assists" value="{{ $item->away_team_score }}">
                            </div>
                            <h4 class="card-header-btn text-right">
                                {{ $item->awayTeam->name }}
                            </h4>
                        </div>
                        <div class="table-responsive collapse show" id="collapse3">
                            <table class="table card-table">
                                <thead>
                                <tr>
                                    <th>{{ __('form.gamers.gamer') }}</th>
                                    <th>{{ __('validation.attributes.goals') }}</th>
                                    <th>{{ __('validation.attributes.assists') }}</th>
                                    <th>{{ __('validation.attributes.yellow_cards') }}</th>
                                    <th>{{ __('validation.attributes.red_cards') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($item->awayTeam->teamGamers as $gamerData)
                                    <tr>
                                        <td>
                                            <div class="media">
                                                @if(!empty($gamerData->gamer->files[0]))
                                                    <img class="wd-30 img-fluid"
                                                         src="{{ Storage::url($gamerData->gamer->files[0]['path']) }}"
                                                         alt="">
                                                @else
                                                    <img class="wd-30 img-fluid"
                                                         src="{{ asset('assets/images/user/user2.png')}}" alt="">
                                                @endif
                                                <div class="media-body mg-l-10">
                                                    <p class="lh-1 mg-0">
                                                        <a href="#accordionHeaderbg1_{{$gamerData->id}}"
                                                           data-toggle="collapse"
                                                           aria-expanded="@if($errors->any()) true @else false @endif"
                                                           aria-controls="accordionHeaderbg1">
                                                            {{ $gamerData->gamer->name }}  {{ $gamerData->gamer->surname }}
                                                        </a>
                                                    </p>
                                                    <small>{{ $gamerData->gamer->position->name }}</small>
                                                </div>
                                            </div>
                                            <div id="accordionHeaderbg">
                                                <div class="card mb-2 col-md-12">
                                                    <div id="accordionHeaderbg1_{{$gamerData->id}}"
                                                         class="collapse @if($errors->any()) show @endif"
                                                         data-parent="#accordionHeaderbg" style="">
                                                        <div class="card-body">
                                                            <div>
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label
                                                                            for="goals">{{ __('validation.attributes.goals') }}</label>
                                                                        <input type="number"
                                                                               name="gamers[{{ $gamerData->id }}][goals]"
                                                                               class="form-control" id="goals"
                                                                               value="{{ old('goals.'.$gamerData->gamer->id) ?? $gamerData->gamer->gameStats[0]->goals ?? 0 }}">
                                                                    </div>
                                                                    <div class="col">
                                                                        <label
                                                                            for="assists">{{ __('validation.attributes.assists') }}</label>
                                                                        <input type="number"
                                                                               name="gamers[{{ $gamerData->id }}][assists]"
                                                                               class="form-control" id="assists"
                                                                               value="{{ old('assists.'.$gamerData->gamer->id) ?? $gamerData->gamer->gameStats[0]->assists ?? 0 }}">
                                                                    </div>
                                                                    <div class="col">
                                                                        <label
                                                                            for="yellow_cards">{{ __('validation.attributes.yellow_cards') }}</label>
                                                                        <input type="number"
                                                                               name="gamers[{{ $gamerData->id }}][yellow_cards]"
                                                                               class="form-control" id="yellow_cards"
                                                                               value="{{ old('yellow_cards.'.$gamerData->gamer->id) ?? $gamerData->gamer->gameStats[0]->yellow_cards ?? 0 }}">
                                                                    </div>
                                                                    <div class="col">
                                                                        <label
                                                                            for="red_cards">{{ __('validation.attributes.red_cards') }}</label>
                                                                        <input type="number"
                                                                               name="gamers[{{ $gamerData->id }}][red_cards]"
                                                                               class="form-control" id="red_cards"
                                                                               value="{{ old('red_cards.'.$gamerData->gamer->id) ?? $gamerData->gamer->gameStats[0]->red_cards ?? 0 }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        @if(!empty($gamerData->gamer->gameStats))
                                            <td>{{ $gamerData->gamer->gameStats[0]->goals }}</td>
                                            <td>{{ $gamerData->gamer->gameStats[0]->assists }}</td>
                                            <td>{{ $gamerData->gamer->gameStats[0]->yellow_cards }}</td>
                                            <td>{{ $gamerData->gamer->gameStats[0]->red_cards }}</td>
                                        @else
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <a href="{{ route('games.index',['day_id' => $item->day_id]) }}"
                   class="btn btn-slack ">{{{ __('form.cancel') }}}</a>
                <button class="btn btn-info">{{ __('form.save') }}</button>
            </div>
        </form>
    </div>

@endsection
