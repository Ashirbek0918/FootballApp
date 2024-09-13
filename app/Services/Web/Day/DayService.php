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
                'files.path as file_path' // Fayl yo'lini olish
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

    public function gamersAllStatistics(?int $perPage = 15)
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

        $gamerStats = $gamerStatsQuery->paginate($perPage);
    }
}
