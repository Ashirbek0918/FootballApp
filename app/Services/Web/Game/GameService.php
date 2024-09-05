<?php

namespace App\Services\Web\Game;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Game\GameActionData;
use App\DataObjects\Game\GameData;
use App\Models\Game;
use App\Models\TeamGameStat;

class GameService
{

    public function paginate(int $page = 1, int $limit = 10, ?iterable $filters = []): DataObjectCollection
    {
        $model = Game::applyEloquentFilters($filters)->with(['awayTeam','homeTeam'])
            ->orderBy('id', 'desc');
        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (Game $game) {
            return GameData::createFromEloquentModel($game);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }


    public function createGame(GameActiondata $actionData):bool
    {
        $data = $actionData->all();
        if($actionData->home_team_id == $actionData->away_team_id){
            return false;
        }
        $game = Game::query()->create($data);
        $result = GameData::fromModel($game);
        $this->saveGameResult($result);
        return true;
    }
    public function updateGame(GameActiondata $actionData, $id): GameData
    {
        $data = $actionData->all();
        $game = $this->getGame($id);
        $result = GameData::fromModel($game);
        $this->saveGameResult($result);
        return $result;
    }
    public function deleteGame(int $id): bool
    {
        $game = $this->getGame($id);
        $game->teamsStats()->delete();
        $game->delete();
        return true;
    }

    public function getGame(int $id): Game
    {
        return Game::query()->findOrFail($id);
    }

    public function show(int $id): GameData
    {
        $game = Game::query()->with(['awayTeam.teamGamers.gamer' => function ($query) {
            $query->with('position','files');
        },'homeTeam.teamGamers.gamer'])->findOrFail($id);
        return  GameData::fromModel($game);

    }
    public function edit(int $id): GameData
    {
        return GameData::fromModel($this->getGame($id));
    }

    public function getGames()
    {
        $games = Game::query()->with('teams')->get();
        return $games->transform(fn(Game $game) => GameData::fromModel($game));
    }


    public function saveGameResult(GameData $data):void
    {
        if($data->away_team_score > $data->home_team_score){
            TeamGameStat::query()->updateOrCreate([
                'game_id' => $data->id,
                'team_id' => $data->away_team_id,
                'won' => true
            ]);
            TeamGameStat::query()->updateOrCreate([
                'game_id' => $data->id,
                'team_id' => $data->home_team_id,
                'lost' => true
            ]);
        }elseif($data->away_team_score < $data->home_team_score){
            TeamGameStat::query()->updateOrCreate([
                'game_id' => $data->id,
                'team_id' => $data->away_team_id,
                'lost' => true
            ]);
            TeamGameStat::query()->updateOrCreate([
                'game_id' => $data->id,
                'team_id' => $data->home_team_id,
                'won' => true
            ]);
        }
        if($data->away_team_score = $data->home_team_score){
            TeamGameStat::query()->updateOrCreate([
                'game_id' => $data->id,
                'team_id' => $data->away_team_id,
                'draw' => true
            ]);
            TeamGameStat::query()->updateOrCreate([
                'game_id' => $data->id,
                'team_id' => $data->home_team_id,
                'draw' => true
            ]);
        }
    }
}
