<?php

namespace App\Services\Web\Game;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Game\GameActionData;
use App\ActionData\Game\GameUpdateActionData;
use App\DataObjects\Game\GameData;
use App\Models\Game;
use App\Models\GamerGameStat;
use App\Models\TeamGamer;
use App\Models\TeamGameStat;

class GameService
{

    public function paginate(int $page = 1, int $limit = 10, ?iterable $filters = []): DataObjectCollection
    {
        $model = Game::applyEloquentFilters($filters)->with(['awayTeam', 'homeTeam'])
            ->orderBy('id', 'desc');
        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (Game $game) {
            return GameData::createFromEloquentModel($game);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }


    public function createGame(GameActiondata $actionData): bool
    {
        $data = $actionData->all();
        if ($actionData->home_team_id == $actionData->away_team_id) {
            return false;
        }
        $game = Game::query()->create($data);
        $result = GameData::fromModel($game);
        $this->saveGameResult($result);
        return true;
    }

    public function updateGame(GameUpdateActiondata $actionData, $id): GameData
    {

        $data = $actionData->all();
        $game = $this->getGame($id);
        $this->saveGamerStat($data['gamers'], $game->id);
        $game->update([
            'home_team_score' => $data['home_team_score'],
            'away_team_score' => $data['away_team_score'],
        ]);
        $this->saveGameResult(GameData::fromModel($game));
        return GameData::createFromEloquentModel($game);
    }

    public function deleteGame(int $id)
    {
        $game = $this->getGame($id);
        $day_id = $game->day_id;
        $game->teamsStats()->delete();
        $game->gameStats()->delete();
        $game->delete();
        return $day_id;
    }

    public function getGame(int $id): Game
    {
        return Game::query()->findOrFail($id);
    }

    public function show(int $id): GameData
    {
        $active = $this->getGame($id);
        $game = Game::query()->with(['awayTeam.teamGamers.gamer' => function ($query) use ($active) {
            $query->with(['position', 'files', 'gameStats' => function ($query) use ($active) {
                $query->where('game_id', $active->id)->where('team_id',$active->away_team_id);
            }]);
        }, 'homeTeam.teamGamers.gamer' => function ($query) use ($active) {
            $query->with(['position', 'files', 'gameStats' => function ($query) use ($active) {
                $query->where('game_id', $active->id)->where('team_id',$active->home_team_id);
            }]);
        }])->findOrFail($id);

        return GameData::fromModel($game);

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


    public function saveGameResult(GameData $data): void
    {
//        dd($data);
        if ($data->away_team_score > $data->home_team_score) {
            TeamGameStat::query()->updateOrCreate([
                'game_id' => $data->id,
                'team_id' => $data->away_team_id,
            ], [
                'won' => true,
                'lose' => false,
                'draw' => false,

            ]);
            TeamGameStat::query()->updateOrCreate([
                'game_id' => $data->id,
                'team_id' => $data->home_team_id,
            ], [
                'lost' => true,
                'draw' => false,
                'won' => false,

            ]);
        }
        if ($data->away_team_score < $data->home_team_score) {
            TeamGameStat::query()->updateOrCreate([
                'game_id' => $data->id,
                'team_id' => $data->away_team_id,
            ],
                [
                    'lost' => true,
                    'draw' => false,
                    'won' => false,
                ]);
            TeamGameStat::query()->updateOrCreate([
                'game_id' => $data->id,
                'team_id' => $data->home_team_id,
            ], [
                'won' => true,
                'lost' => false,
                'draw' => false,
            ]);
        }
        if ($data->away_team_score ===  $data->home_team_score) {

            TeamGameStat::query()->updateOrCreate([
                'game_id' => $data->id,
                'team_id' => $data->away_team_id,
            ], [
                    'draw' => true,
                    'lost' => false,
                    'won' => false,
                ]
            );
            TeamGameStat::query()->updateOrCreate([
                'game_id' => $data->id,
                'team_id' => $data->home_team_id,
            ],[
                'draw' => true,
                'lost' => false,
                'won' => false,
            ]);
        }
    }

    public function saveGamerStat(array $gamers, $game_id): void
    {
        foreach ($gamers as $key => $gamer) {
            $teamGamer = TeamGamer::with('gamer')->findOrFail($key);
            GamerGameStat::query()->updateOrCreate([
                    'game_id' => $game_id,
                    'gamer_id' => $teamGamer->gamer->id,
                    'team_id' => $teamGamer->team_id,
                ]
                , [
                    'goals' => $gamer['goals'],
                    'assists' => $gamer['assists'],
                    'yellow_cards' => $gamer['yellow_cards'],
                    'red_cards' => $gamer['red_cards'],
                ]);
        }
    }
}
