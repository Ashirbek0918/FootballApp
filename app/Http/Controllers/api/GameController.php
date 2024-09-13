<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Services\Web\Day\DayService;
use App\Services\Web\Game\GameService;
use http\Env\Response;
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

    public function monthly(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');

        $perPage = $request->input('per_page', 15);

        $gamers = $this->dayService->monthly($from, $to, $perPage);

        return response()->json($gamers);
    }
}
