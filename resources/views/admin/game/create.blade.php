<div class="modal fade" id="m_modal_{{ $day->id }}" tabindex="-1" role="dialog"
     style="display: none; padding-right: 15px;">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">

            <form action="{{ route('games.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <input type="hidden" name="day_id" value="{{ $day->id }}">
                        <div class="col-md-6 mb-3">
                            <select class="form-control select2 select2-hidden-accessible" tabindex="-1"
                                    aria-hidden="true" id="home_team_id" name="home_team_id">
                                <option value="" selected
                                        disabled>{{ __('form.game.home_team') }} {{ __('form.choose') }}</option>
                                @foreach($pagination->items() as $team)
                                    <option
                                        value="{{ $team->id }}"
                                        @selected(request('home_team_id') == $team->id)
                                    >{{ $team->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('home_team_id'))
                                <div class="text-danger">{{ $errors->first('home_team_id') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <select class="form-control select2 select2-hidden-accessible" tabindex="-1"
                                    aria-hidden="true" id="away_team_id" name="away_team_id">
                                <option value="" selected
                                        disabled>{{ __('form.game.away_team') }} {{ __('form.choose') }}</option>
                                @foreach($pagination->items() as $team)
                                    <option
                                        value="{{ $team->id }}"
                                        @selected(request('away_team_id') == $team->id)
                                    >{{ $team->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('away_team_id'))
                                <div class="text-danger">{{ $errors->first('away_team_id') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class=" modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('form.close') }}</button>
                    <button  class="btn btn-success">{{ __('form.add') }}</button>
                </div>
            </form>
            {{--            <div class="modal-header">--}}
            {{--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
            {{--                    <span aria-hidden="true"><i class="ion-ios-close-empty"></i></span>--}}
            {{--                </button>--}}
            {{--            </div>--}}

        </div>
    </div>
</div>
@section('script')
    <script>
        $(document).on('shown.bs.modal', function (event) {
            var modal = $(event.target);
            var homeTeamSelect = modal.find('#home_team_id');
            var awayTeamSelect = modal.find('#away_team_id');

            function updateTeamOptions() {
                var selectedHomeTeam = homeTeamSelect.val();
                var selectedAwayTeam = awayTeamSelect.val();

                homeTeamSelect.find('option').each(function () {
                    $(this).show();
                });
                awayTeamSelect.find('option').each(function () {
                    $(this).show();
                });

                if (selectedHomeTeam) {
                    awayTeamSelect.find('option[value="' + selectedHomeTeam + '"]').hide();
                }

                if (selectedAwayTeam) {
                    homeTeamSelect.find('option[value="' + selectedAwayTeam + '"]').hide();
                }
            }

            homeTeamSelect.on('change', updateTeamOptions);
            awayTeamSelect.on('change', updateTeamOptions);

            updateTeamOptions();
        });
    </script>
@endsection
