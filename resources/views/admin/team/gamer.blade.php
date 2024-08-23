<table class="table table-responsive-sm">
    <thead>
    <tr>
        <form action="{{ route("gamers.index") }}">
            <td>
                <select
                    class="form-control select2 select2-hidden-accessible gamer-select"
                    name="limit"
                    style="width: 65px" id="limit">
                    <option value="5" @selected(request('limit') == 5)>5</option>
                    <option
                        value="10" @selected(request('limit') == 10 || is_null(request('limit')))>
                        10
                    </option>
                    <option value="20" @selected(request('limit') == 20)>20</option>
                    <option value="30" @selected(request('limit') == 30)>30</option>
                </select>
            </td>
            <td>
                <input type="text" class="form-control col-md-12 gamer-input"
                       name="search"
                       placeholder="{{ __('form.search') }}"
                       value="{{ request('search') }}">
            </td>
            <td>
                <select
                    class="col-md-12 form-control select2 select2-hidden-accessible gamer-select"
                    tabindex="-1"
                    aria-hidden="true" id="position_id" name="position_id">
                    <option value=""
                            selected>{{ __('form.positions.positions') }} {{ __('form.choose') }}</option>
                    @foreach($positions as $position)
                        <option
                            value="{{ $position->id }}"
                            @selected(request('position_id') == $position->id)
                        >{{ $position->name }}</option>
                    @endforeach
                </select>
            </td>
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
            <th><input type="checkbox" name="gamers[]" class="gamers"
                       value="{{ $gamer->id }}"></th>
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
