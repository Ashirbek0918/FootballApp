@extends('dashboard.home')

@section('content')
    <div class="d-flex col-md-12 mt-5">
        <form action="{{ route('teams.update',$team->id) }} " method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-row">
                <div class="col-lg-6  col-md-12 ">
                    <div class="card mb-4 shadow-1 d-flex justify-content-lg-center">
                        <div class="card-body ">
                            <div class="form-row d-flex justify-content-lg-center">
                                <div class="col-md-8 mb-3">
                                    <label for="content"
                                           class="form-control-label">{{ __('validation.attributes.name') }}</label>
                                    <input type="text" class="form-control"
                                           name="name" id="name" value="{{ old('name',$team->name) }}">
                                    @if($errors->has('name'))
                                        <div class="text-danger">{{ $errors->first('name') }}</div>
                                    @endif
                                    <input type="hidden" id="day_id" name="day_id" value="{{ $team->day_id }}">
                                </div>

                            </div>
                        </div>

                        <hr style="border: 1px solid slategray; border-radius: 2px;">
                        <div class="card-body collapse show col-md-12" id="gamers-table">
                            @include('admin.team.gamerEdit')
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
                                    <th>{{ __('validation.attributes.name') }}</th>
                                    <th>{{ __('form.positions.position') }}</th>
                                    <th>{{ __('validation.attributes.age') }}</th>
                                    <th>{{ __('validation.attributes.weight') }}</th>
                                    <th>{{ __('validation.attributes.height') }}</th>

                                </tr>
                                </thead>
                                <tbody id="gamers-all">
                                @foreach($team->teamGamers as $teamGamer)
                                    <tr class="{{ $teamGamer->id }}">
                                        <th><input checked type="checkbox" name="gamers[]"
                                                   value="{{ $teamGamer->gamer->id }}"></th>
                                        <td>{{ $teamGamer->gamer->name }}</td>
                                        <td>{{ $teamGamer->gamer->position->name}}</td>
                                        <td>{{ $teamGamer->gamer->age }}</td>
                                        <td>{{ $teamGamer->gamer->weight }}</td>
                                        <td>{{ $teamGamer->gamer->height }}</td>

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
                    <a href="{{ route('days.show',['day_id' => $team->day_id]) }}"
                       class="btn btn-slack col-md-2">{{{ __('form.cancel') }}}</a>
                    <button class="btn btn-info col-md-2">{{ __('form.save') }}</button>
                </div>
            </div>
        </form>

    </div>

@endsection
@section('script')
    <script>
        let selectedGamers = [];

        $(document).on('change', '#gamer-list .gamers', function (e) {
            let gamerId = e.target.getAttribute('value');
            let isChecked = e.target.checked;

            if (isChecked) {
                if (!selectedGamers.includes(gamerId)) {
                    selectedGamers.push(gamerId);
                    let clonedElement = e.target.closest('tr').cloneNode(true);
                    $('#gamers-all').append(clonedElement);
                }
            } else {
                selectedGamers.splice(selectedGamers.indexOf(gamerId), 1);
                $(`#gamers-all .${gamerId}`).remove();
            }
        });

        $(document).on('click', '.page-link', function (e) {
            e.preventDefault();
            let href = e.target.getAttribute('href');
            sendAjaxRequest(href);
        });

        $(document).on('change', '.gamer-select', function (e) {
            e.preventDefault();
            updateGamersList();
        });

        $(document).on('input', '.gamer-input', function (e) {
            e.preventDefault();
            updateGamersList();
        });

        function updateGamersList() {
            let limit = $("#limit").val();
            let search = $(".gamer-input").val();
            let position_id = $("#position_id").val();
            let day_id = $('#day_id').val();

            let path = window.location.href.split('?')[0];
            let query = `?search=${search}&limit=${limit}&position_id=${position_id}&day_id=${day_id}&gamer=1`;

            sendAjaxRequest(path + query);
        }

        function sendAjaxRequest(url) {
            $.ajax({
                url: `${url}&gamer=1`,
                method: 'GET',
                success: function (data) {
                    $("#gamers-table").html(data);
                    $('.gamers').each(function () {
                        let gamerId = $(this).val();
                        if (selectedGamers.includes(gamerId)) {
                            $(this).prop('checked', true);
                        }
                    })
                    const inputElement = $(".gamer-input")
                    const originalValue = inputElement.val();
                    inputElement.val('');
                    inputElement.blur().focus().val(originalValue);
                },
                error: function (error) {
                    console.error('Error:', error);
                }
            });
        }
    </script>

@endsection

