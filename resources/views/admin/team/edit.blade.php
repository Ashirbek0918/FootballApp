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
                            <table class="table table-responsive-sm">
                                <thead>
                                <tr>
                                    <form action="{{ route("gamers.index") }}">
                                        {{--                                        <td>--}}
                                        {{--                                            <select--}}
                                        {{--                                                class="form-control select2 select2-hidden-accessible gamer-select"--}}
                                        {{--                                                name="limit"--}}
                                        {{--                                                style="width: 65px" id="limit">--}}
                                        {{--                                                <option value="5" @selected(request('limit') == 5)>5</option>--}}
                                        {{--                                                <option--}}
                                        {{--                                                    value="10" @selected(request('limit') == 10 || is_null(request('limit')))>--}}
                                        {{--                                                    10--}}
                                        {{--                                                </option>--}}
                                        {{--                                                <option value="20" @selected(request('limit') == 20)>20</option>--}}
                                        {{--                                                <option value="30" @selected(request('limit') == 30)>30</option>--}}
                                        {{--                                            </select>--}}
                                        {{--                                        </td>--}}
                                        {{--                                        <td>--}}
                                        {{--                                            <input type="text" class="form-control col-md-12 gamer-input"--}}
                                        {{--                                                   name="search"--}}
                                        {{--                                                   placeholder="{{ __('form.search') }}"--}}
                                        {{--                                                   value="{{ request('search') }}">--}}
                                        {{--                                        </td>--}}
                                        {{--                                        <td>--}}
                                        {{--                                            <select--}}
                                        {{--                                                class="col-md-12 form-control select2 select2-hidden-accessible gamer-select"--}}
                                        {{--                                                tabindex="-1"--}}
                                        {{--                                                aria-hidden="true" id="position_id" name="position_id">--}}
                                        {{--                                                <option value=""--}}
                                        {{--                                                        selected>{{ __('form.positions.positions') }} {{ __('form.choose') }}</option>--}}
                                        {{--                                                @foreach($positions as $position)--}}
                                        {{--                                                    <option--}}
                                        {{--                                                        value="{{ $position->id }}"--}}
                                        {{--                                                        @selected(request('position_id') == $position->id)--}}
                                        {{--                                                    >{{ $position->name }}</option>--}}
                                        {{--                                                @endforeach--}}
                                        {{--                                            </select>--}}
                                        {{--                                        </td>--}}
                                    </form>
                                </tr>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('validation.attributes.name') }}</th>
                                    <th>{{ __('form.positions.position') }}</th>
                                    <th>{{ __('validation.attributes.age') }}</th>
                                    <th>{{ __('validation.attributes.weight') }}</th>
                                    <th>{{ __('validation.attributes.height') }}</th>

                                </tr>
                                </thead>
                                <tbody id="gamer-list">
                                @foreach($pagination->items() as $gamer)
                                    <tr class="{{ $gamer->id }}">
                                        <th><input class="gamers"
                                                   @checked(in_array($gamer->id, array_column($team->teamGamers, 'gamer_id')))
                                                   type="checkbox" name="gamers[]" value="{{ $gamer->id }}"></th>
                                        <td>{{ $gamer->name }}</td>
                                        <td>{{ $gamer->position->name}}</td>
                                        <td>{{ $gamer->age }}</td>
                                        <td>{{ $gamer->weight }}</td>
                                        <td>{{ $gamer->height }}</td>

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
        let items = []

        const elements = document.getElementById('gamers-all')
        elements.childNodes.forEach(function (item) {
            if (item.className) {
                items.push(item.className)
            }
        })

        console.log(items)
        $(document).on('change', '#gamer-list .gamers', function (e) {
            let id = e.target.getAttribute('value')
            console.log(items, id, items.includes(id))
            if (!items.includes(id)) {
                items.push(id)
                let element = e.target.parentElement.parentElement.cloneNode(true)

                $('#gamers-all').append(element)
            } else {
                items.splice(items.indexOf(id), 1)
                $(`#gamers-all .${id}`).remove()
            }
        })
        $(document).on('click', '.page-link', function (e) {
            e.preventDefault()
            let href = e.target.getAttribute('href')
            $.ajax({
                url: `${href}&gamer=1`, // Sample API endpoint
                method: 'GET',
                // dataType: 'json',
                success: function (data) {
                    // Update the content on success
                    $("#gamers-table").html(data);
                    $('.gamers').get().forEach(function (item) {
                        let itemValue = item.getAttribute('value')
                        if (items.includes(itemValue)) {
                            item.checked = true
                        }
                    })
                },
                error: function (error) {
                    // Handle errors
                    console.error('Error:', error);
                }
            });
        })

        // filters
        $(document).on('change', '.gamer-select', function (e) {
            e.preventDefault()
            let limit = $("#limit").val()
            let name = $(".gamer-input").val()
            let position_id = $("#position_id").val()

            let path = window.location.href.split('?')[0]
            path += `?name=${name}&limit=${limit}&position_id=${position_id}`
            // console.log(path)

            console.log(name)
            $.ajax({
                url: `${path}&gamer=1`, // Sample API endpoint
                method: 'GET',
                // dataType: 'json',
                success: function (data) {
                    // Update the content on success
                    $("#gamers-table").html(data);
                    $('.gamers').get().forEach(function (item) {
                        let itemValue = item.getAttribute('value')
                        if (items.includes(itemValue)) {
                            item.checked = true
                        }
                    })
                },
                error: function (error) {
                    // Handle errors
                    console.error('Error:', error);
                }
            });
        })
        $(document).on('input', '.gamer-input', function (e) {
            e.preventDefault()
            let limit = $("#limit").val()
            let name = $(".gamer-input").val()
            let position_id = $("#position_id").val()

            let path = window.location.href.split('?')[0]
            path += `?name=${name}&limit=${limit}&position_id=${position_id}`
            // console.log(path)

            $.ajax({
                url: `${path}&gamer=1`, // Sample API endpoint
                method: 'GET',
                // dataType: 'json',
                success: function (data) {
                    // Update the content on success
                    $("#gamers-table").html(data);
                    $('.gamers').get().forEach(function (item) {
                        let itemValue = item.getAttribute('value')
                        if (items.includes(itemValue)) {
                            item.checked = true
                        }
                    })
                    const inputElement = $(".gamer-input")
                    const originalValue = inputElement.val();
                    inputElement.val('');
                    inputElement.blur().focus().val(originalValue);
                },
                error: function (error) {
                    // Handle errors
                    console.error('Error:', error);
                }
            });
        })
    </script>

@endsection

