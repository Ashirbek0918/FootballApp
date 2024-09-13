@extends('dashboard.home')
@section('content')

    <div class="row mt-5">
        <!--================================-->
        <!-- Today Purchases Start -->
        <!--================================-->
        <div class="text-center col-md-12">
            <p class="tx-20 text-black-50 mg-0">{{ __('form.game.game_stat') }}</p>
        </div>
        {{--        @dd($item)--}}
        <div class="col-md-6 mt-4">
            <div class="card mg-b-30 shadow-1">
                <div class="card-header">

                    <h4 class="card-header-title">
                        {{ $item->homeTeam->name }}
                    </h4>
                    <div class="card-header-btn">
                        {{ $item->home_team_score }}
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
                                                 src="{{ Storage::url($gamerData->gamer->files[0]['path']) }}" alt="">
                                        @else
                                            <img class="wd-30 img-fluid"
                                                 src="{{ asset('assets/images/user/user2.png')}}"
                                                 alt="">
                                        @endif
                                        <div class="media-body mg-l-10">
                                            <p class="lh-1 mg-0">{{ $gamerData->gamer->name }}  {{ $gamerData->gamer->surname }}</p>
                                            <small> {{ $gamerData->gamer->position->name }}</small>
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
        <!--/ Today Purchases End -->
        <!--================================-->
        <!-- Top Purchases Start -->
        <!--================================-->
        <div class="col-md-6 mt-4">
            <div class="card mg-b-30 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">
                        {{ $item->away_team_score }}
                    </h4>
                    <div class="card-header-btn ">
                        {{ $item->awayTeam->name }}
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
                        @foreach($item->awayTeam->teamGamers as $gamerData)
                            <tr>
                                <td>
                                    <div class="media">
                                        @if(!empty($gamerData->gamer->files[0]))
                                            <img class="wd-30 img-fluid"
                                                 src="{{ Storage::url($gamerData->gamer->files[0]['path']) }}" alt="">
                                        @else
                                            <img class="wd-30 img-fluid"
                                                 src="{{ asset('assets/images/user/user2.png')}}"
                                                 alt="">
                                        @endif
                                        <div class="media-body mg-l-10">
                                            <p class="lh-1 mg-0">{{ $gamerData->gamer->name }}  {{ $gamerData->gamer->surname }}</p>
                                            <small> {{ $gamerData->gamer->position->name }}</small>
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
        <!--/ Top Purchases End -->
    </div>

@endsection
