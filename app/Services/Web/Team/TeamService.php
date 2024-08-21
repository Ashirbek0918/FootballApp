<?php

namespace App\Services\Web\Team;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Team\TeamActionData;
use App\DataObjects\Team\TeamData;
use App\Models\Game;
use App\Models\Team;
use App\Models\TeamGamer;
use Exception;
use Illuminate\Support\Facades\DB;

class TeamService
{
    public function paginate(int $page = 1, int $limit = 3, ?iterable $filters = []): DataObjectCollection
    {
        $model = Team::applyEloquentFilters($filters)->with('teamGamers.gamer.position')
            ->orderBy('teams.id', 'desc');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (Team $team) {
            return TeamData::createFromEloquentModel($team);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }

    public function createTeam(TeamActiondata $actionData): bool
    {
        $data = $actionData->all();
        DB::beginTransaction();
        try {
            $team = Team::query()->create($data);
            if (isset($data['gamers'])) {
                foreach ($data['gamers'] as $gamer) {
                    TeamGamer::query()->updateOrCreate([
                        'team_id' => $team->id,
                        'gamer_id' => $gamer
                    ]);
                }
            }
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return false;
        }
        return true;
    }

    public function updateTeam(TeamActiondata $actionData, $id): TeamData
    {
        $data = $actionData->all();
        $team = $this->getTeam($id);
        $team->update($data);
        if (isset($data['gamers'])) {
            foreach ($data['gamers'] as $gamer) {
                TeamGamer::query()->updateOrCreate([
                    'team_id' => $id,
                    'gamer_id' => $gamer
                ]);
            }
        }
        return TeamData::createFromEloquentModel($team);
    }

    public function deleteTeam(int $id)
    {
        $team = $this->getTeam($id);
        $action = Game::query()->where('away_team_id', $id)->orWhere('home_team_id', $id)->first();
        if ($action) {
            return false;
        }
        $team->teamGamers()->delete();
        $team->delete();
        return true;
    }

    public function getTeam(int $id): Team
    {
        return Team::query()->with('teamGamers.gamer.position')->findOrFail($id);
    }

    public function edit(int $id): TeamData
    {
        return TeamData::fromModel($this->getTeam($id));
    }

    public function getTeams(int $day_id)
    {
        $teams = Team::query()->with('teamGamers')->where('day_id', '=', $day_id)->get();
        return $teams->transform(fn(Team $team) => TeamData::fromModel($team));
    }

    public function detachGamer(int $id){
        $teamGamer = TeamGamer::query()->findOrFail($id);
        $team = $this->getTeam($teamGamer->team_id);
        $teamGamer->delete();
        return $team->day_id;
    }
}
