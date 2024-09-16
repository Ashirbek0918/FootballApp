<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DayTeamsRequest;
use App\Services\Web\Day\DayService;
use App\Services\Web\Game\GameService;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GameController extends Controller
{

    public function __construct(
        protected DayService  $dayService,
        protected GameService $gameService,
    )
    {
    }
    public function expectedGames(Request $request){
       $day = $this->dayService->expectedDay();
       if(empty($day)){
           return response()->json([
               'success' => false,
           ],404);
       }
       return response()->json([
           'success' => true,
           'data' => $day
       ]);
    }

    public function monthly(Request $request):JsonResponse
    {
        $from = $request->input('from');
        $to = $request->input('to');
        $perPage = $request->input('per_page', 15);

        $gamers = $this->dayService->monthly(from: $from,to:  $to,perPage:  $perPage);

        return response()->json([
            'success' => true,
            'pagination' => [
                'current_page' => $gamers->currentPage(),
                'per_page' => $gamers->perPage(),
                'total' => $gamers->total(),
                'last_page' => $gamers->lastPage(),
            ],
            'data' => $gamers->items(),

        ]);
    }

    public function gamersAllStatistics(Request $request):JsonResponse
    {
        $dayId = $request->input('day_id');
        $gamerId = $request->input('gamer_id');
        $positionId = $request->input('position_id');
        $perPage = $request->input('per_page', 15);
        $gamerStats = $this->dayService->gamersAllStatistics(dayId: $dayId, positionId: $positionId,gamerId:  $gamerId,perPage:  $perPage);
        if ($gamerId && count($gamerStats) > 0){
            return response()->json([
                'success' => true,
                'data' => $gamerStats[0]
            ]);
        }
        return response()->json([
            'success' => true,
            'pagination' => [
                'current_page' => $gamerStats->currentPage(),
                'per_page' => $gamerStats->perPage(),
                'total' => $gamerStats->total(),
                'last_page' => $gamerStats->lastPage(),
            ],
            'data' => $gamerStats->items(),
        ]);
    }

    public function allDays()
    {
        $days = $this->dayService->allDays();
        return response()->json([
            'success' => true,
            'data' => $days
        ]);
    }

    public function dayTeams(DayTeamsRequest $request):JsonResponse
    {
        $day_id = $request->input('day_id');
        $teams = $this->dayService->getTeamRatingsForDay($day_id);
        return response()->json([
            'success' => true,
            'data' => $teams
        ]);
    }
}
