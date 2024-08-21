<?php

namespace App\Services\Web\Gamer;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Gamers\CreateGamerActionData;
use App\ActionData\Gamers\UpdateGamerActionData;
use App\DataObjects\Gamers\GamerData;
use App\Models\Gamer;
use App\Services\Web\File\FileService;

class GamerService
{

    public function paginate(int $page =1, int $limit =10 ,?iterable $filters = [] ):DataObjectCollection
    {
        $model = Gamer::applyEloquentFilters($filters)->with('position','files')
            ->orderBy('id', 'desc');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (Gamer $gamer) {
            return GamerData::createFromEloquentModel($gamer);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }


    public function createGamer(CreateGamerActiondata $actionData): GamerData
    {
        $data = $actionData->all();
        $gamer = Gamer::query()->create($data);
        if (isset($data['files'])) {
            foreach ($data['files'] as $file) {
                FileService::uploadFile(file: $file['file'], model: $gamer, diskName: 'gamer');
            }
        }
        return GamerData::fromModel($gamer);

    }

    /**
     * @param UpdateGamerActionData $actionData
     * @param $id
     * @return GamerData
     */
    public function updateGamer(UpdateGamerActiondata $actionData, $id): GamerData
    {
        $data = $actionData->all();
        $gamer = $this->getGamer($id);
        $gamer->update($data);
        if (isset($data['files'])) {
            foreach ($gamer->files as $file) {
                FileService::fileDelete(diskName: 'gamer',id:  $file->id);
            }
            foreach ($data['files'] as $file) {
                FileService::uploadFile(file: $file['file'], model: $gamer, diskName: 'gamer');
            }
        }
        return GamerData::createFromEloquentModel($gamer);
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteGamer(int $id): void
    {
        $gamer = $this->getGamer($id);
        if (count($gamer->files)){
            foreach ($gamer->files as $file) {
                FileService::fileDelete(diskName: 'gamer',id:  $file->id);
            }
        }
        $gamer->delete();
    }

    /**
     * @param int $id
     * @return Gamer
     */
    public function getGamer(int $id): Gamer
    {
        return Gamer::query()->with('position','files')->findOrFail($id);
    }

    /**
     * @param int $id
     * @return GamerData
     */
    public function edit(int $id):GamerData
    {
        return GamerData::fromModel($this->getGamer($id));
    }

    public function getGamers()
    {
        $gamers = Gamer::query()->with('position','files')->get();
        return $gamers->transform(fn(Gamer $gamer) => GamerData::fromModel($gamer));
    }
}
