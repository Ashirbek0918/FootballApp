<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Services\Web\Day\DayService;
use App\Services\Web\Game\GameService;
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

    }


}
