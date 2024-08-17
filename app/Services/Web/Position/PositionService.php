<?php

namespace App\Services\Web\Position;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Position\CreatePositionActionData;
use App\DataObjects\Position\PositionData;
use App\Models\Position;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class PositionService
{

    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page =1, int $limit =10 ,?iterable $filters = [] ):DataObjectCollection
    {
        $model = Position::applyEloquentFilters($filters)->with('gamers')
            ->orderBy('positions.id', 'desc');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (Position $position) {
            return PositionData::createFromEloquentModel($position);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }


    /**
     * @param CreatePositionActionData $actionData
     * @return PositionData
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createPosition(CreatePositionActiondata $actionData): PositionData
    {
        $actionData->addValidationRules([
            'name' => ['required', 'string','unique:positions,name'],
        ]);
        $actionData->validateException();
        $data = $actionData->all();
        $position = Position::query()->create($data);
        return PositionData::fromModel($position);

    }

    /**
     * @param CreatePositionActionData $actionData
     * @param $id
     * @return PositionData
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updatePosition(CreatePositionActiondata $actionData, $id): PositionData
    {
        $actionData->addValidationRules([
            'name' => 'required|unique:positions,name,'.$id,
        ]);
        $actionData->validateException();
        $data = $actionData->all();
        $position = $this->getPosition($id);
        $position->update($data);
        return PositionData::createFromEloquentModel($position);
    }

    /**
     * @param int $id
     * @return void
     */
    public function deletePosition(int $id): bool
    {
        $position = $this->getPosition($id);
        if($position->gamers_count > 0){
            return false;
        }
        $position->delete();
        return true;
    }

    /**
     * @param int $id
     * @return Position
     */
    public function getPosition(int $id): Position
    {
        return Position::query()->withCount('gamers')->findOrFail($id);
    }

    /**
     * @param int $id
     * @return PositionData
     */
    public function edit(int $id):PositionData
    {
        return PositionData::fromModel($this->getPosition($id));
    }

    /**
     * @return Position[]|Builder[]|Collection|\Illuminate\Support\Collection
     */
    public function getPositions()
    {
        $positions = Position::query()->with('gamers')->get();
        return $positions->transform(fn(Position $position) => PositionData::fromModel($position));
    }

}
