<?php

namespace App\Services\Web\Day;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Day\DayActionData;
use App\DataObjects\Day\DayData;
use App\Models\Day;
use Illuminate\Validation\ValidationException;

class DayService
{

    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 10, ?iterable $filters = []): DataObjectCollection
    {
        $model = Day::applyEloquentFilters($filters)->withCount('teams')
            ->orderBy('id', 'desc');
        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (Day $position) {
            return DayData::createFromEloquentModel($position);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }


    /**
     * @param DayActionData $actionData
     * @return DayData
     * @throws ValidationException
     */
    public function createDay(DayActiondata $actionData): DayData
    {
        $actionData->addValidationRules([
            'day' => ['required', 'string', 'unique:days,day'],
        ]);
        $actionData->validateException();
        $data = $actionData->all();
        $position = Day::query()->create($data);
        return DayData::fromModel($position);

    }


    /**
     * @param DayActionData $actionData
     * @param $id
     * @return DayData
     * @throws ValidationException
     */
    public function updateDay(DayActiondata $actionData, $id): DayData
    {
        $actionData->addValidationRules([
            'day' => 'required|unique:days,day,' . $id,
        ]);
        $actionData->validateException();
        $data = $actionData->all();
        $position = $this->getDay($id);
        $position->update($data);
        return DayData::createFromEloquentModel($position);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteDay(int $id): bool
    {
        $position = $this->getDay($id);
        if ($position->teams_count > 0) {
            return false;
        }
        $position->delete();
        return true;
    }

    /**
     * @param int $id
     * @return Day
     */
    public function getDay(int $id): Day
    {
        return Day::query()->with('teams')->withCount('teams')->findOrFail($id);
    }

    /**
     * @param int $id
     * @return DayData
     */
    public function edit(int $id): DayData
    {
        return DayData::fromModel($this->getDay($id));
    }

    public function getDays()
    {
        $positions = Day::query()->orderBy('day','DESC')->withCount('teams')->get();
        return $positions->transform(fn(Day $position) => DayData::fromModel($position));
    }

    public function getLastDay()
    {
        $lastDay = Day::query()->latest()->first();
        return $lastDay;
    }

    public function expextedDay()
    {
        $today = now()->format('Y-m-d');
        $days = Day::query()->where('day','<=',$today)->first();
    }

}
