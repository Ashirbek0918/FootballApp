<?php

namespace App\Services\Web\Day;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Day\DayActionData;
use App\DataObjects\Day\DayData;
use App\Models\Day;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
            ->orderBy('day', 'desc');
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
        $positions = Day::query()->orderBy('day', 'DESC')->withCount('teams')->get();
        return $positions->transform(fn(Day $position) => DayData::fromModel($position));
    }

    public function getLastDay()
    {
        $lastDay = Day::query()->latest()->first();
        return $lastDay;
    }

    public function expectedDay()
    {
        $today = now()->format('Y-m-d');
        $day = Day::query()->whereDate('day', '>=', $today)
            ->orderBy('day', 'asc')
            ->first();
        return $day;
    }

    public function monthly(?string $from = null, ?string $to = null, ?int $perPage = 15)
    {
        $from = $from ? now()->create($from)->format('Y-m-d') : now()->startOfMonth()->format('Y-m-d');
        $to = $to ? now()->create($to)->format('Y-m-d') : now()->endOfMonth()->format('Y-m-d');

        $gamerStatsQuery = DB::table('gamer_game_stats')
            ->join('gamers', 'gamer_game_stats.gamer_id', '=', 'gamers.id')
            ->join('games', 'gamer_game_stats.game_id', '=', 'games.id')
            ->join('days', 'games.day_id', '=', 'days.id')
            ->join('positions', 'gamers.position_id', '=', 'positions.id')
            ->leftJoin('files', 'files.fileable_id', '=', 'gamers.id')
            ->whereBetween('days.day', [$from, $to])
            ->select(
                'gamers.id as gamer_id',
                'gamers.name as gamer_name',
                'positions.name as position_name',
                DB::raw('COUNT(games.id) as total_games'),
                DB::raw('SUM(gamer_game_stats.goals) as total_goals'),
                DB::raw('SUM(gamer_game_stats.assists) as total_assists'),
                'files.path as file_path'
            )
            ->groupBy('gamers.id', 'gamers.name', 'positions.name', 'files.path')
            ->orderByDesc('total_goals')
            ->orderByDesc('total_assists');

        $gamerStats = $gamerStatsQuery->paginate($perPage);

        $gamerStats->getCollection()->transform(function ($gamer) {

            $gamer->file_url = $gamer->file_path ? Storage::url($gamer->file_path) : null;
            unset($gamer->file_path);
            return $gamer;
        });

        return $gamerStats;
    }

    public function gamersAllStatistics(?int $dayId = null, ?int $positionId = null,?int $gamerId = null, ?int $perPage = 15)
    {
        $gamerStatsQuery = DB::table('gamer_game_stats')
            ->join('gamers', 'gamer_game_stats.gamer_id', '=', 'gamers.id')
            ->join('games', 'gamer_game_stats.game_id', '=', 'games.id')
            ->join('days', 'games.day_id', '=', 'days.id')
            ->join('positions', 'gamers.position_id', '=', 'positions.id')
            ->leftJoin('files', 'files.fileable_id', '=', 'gamers.id')
            ->select(
                'gamers.id as gamer_id',
                'gamers.name as gamer_name',
                'positions.name as position_name',
                DB::raw('COUNT(games.id) as total_games'),
                DB::raw('COUNT(days.id) as total_comes'),
                DB::raw('SUM(gamer_game_stats.goals) as total_goals'),
                DB::raw('SUM(gamer_game_stats.assists) as total_assists'),
                DB::raw('SUM(gamer_game_stats.yellow_cards) as total_yellow_cards'),
                DB::raw('SUM(gamer_game_stats.red_cards) as total_red_cards'),
                'files.path as file_path'
            )
            ->groupBy('gamers.id', 'gamers.name', 'positions.name', 'files.path')
            ->orderByDesc('total_goals')
            ->orderByDesc('total_assists');

        if ($dayId) {
            $gamerStatsQuery->where('days.id', $dayId);
        }

        if ($gamerId) {
            $gamerStatsQuery->where('gamers.id', $gamerId);
        }
        if ($positionId) {
            $gamerStatsQuery->where('positions.id', $positionId);
        }
        $gamerStats = $gamerStatsQuery->paginate($perPage);
        return $gamerStats;
    }

    public function alldays()
    {
        $today = now()->subDay()->format('Y-m-d');
        $days = Day::query()->whereDate('day', '<=', $today)
            ->orderBy('day', 'desc')
            ->get();
        return $days;
    }

    public function getTeamRatingsForDay($dayId)
    {
//        $day = Day::query()->find($dayId);
//        $day = Day::query()->with(['teams.teamStats'])->findOrFail($dayId);
//
//        $teams = $day->teams;
//
//        $teamRatings = $teams->map(function ($team) {
//            $playedGames = $team->teamStats->count(); // O'ynagan o'yinlar soni
//            $wonGames = $team->teamStats->where('won', true)->count(); // Yutgan o'yinlar
//            $lostGames = $team->teamStats->where('lost', true)->count(); // Yutqazgan o'yinlar
//            $drawGames = $team->teamStats->where('draw', true)->count(); // Duranglar
//
//            $rating = [
//                'team_name'    => $team->name,
//                'played_games' => $playedGames,
//                'won_games'    => $wonGames,
//                'lost_games'   => $lostGames,
//                'draw_games'   => $drawGames,
//            ];
//
//            return $rating;
//        });
//
//// Eng ko'p yutgan jamoalar bo'yicha saralash
//        $sortedByWins = $teamRatings->sortByDesc('won_games');
//
//// Eng ko'p o'ynagan jamoalar bo'yicha saralash
//        $sortedByPlayed = $teamRatings->sortByDesc('played_games');
//
//// Durang qilgan jamoalar bo'yicha saralash
//        $sortedByDraws = $teamRatings->sortByDesc('draw_games');
//
//// Yutqazgan jamoalar bo'yicha saralash
//        $sortedByLosses = $teamRatings->sortByDesc('lost_games');

        $teamRatingsQuery = DB::table('teams')
            ->leftJoin('team_game_stats', 'teams.id', '=', 'team_game_stats.team_id')
            ->leftJoin('games', 'team_game_stats.game_id', '=', 'games.id')
            ->leftJoin('days', 'games.day_id', '=', 'days.id')
            ->where('teams.day_id', $dayId)
            ->select(
                'teams.id as team_id',
                'teams.name as team_name',
                DB::raw('COUNT(team_game_stats.id) as played_games'),
                DB::raw('COALESCE(SUM(team_game_stats.won), 0) as won_games'),
                DB::raw('COALESCE(SUM(team_game_stats.lost), 0) as lost_games'),
                DB::raw('COALESCE(SUM(team_game_stats.draw), 0) as draw_games')
            )
            ->groupBy('teams.id', 'teams.name')
            ->orderByDesc('won_games')
            ->orderByDesc('draw_games')
            ->orderByDesc('played_games')
            ->get();

//        return $sortedByDraws;
        return $teamRatingsQuery;
    }



}
