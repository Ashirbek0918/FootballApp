<?php

namespace App\ActionData\Game;

use Akbarali\ActionData\ActionDataBase;

class GamerGameStatActionData extends ActionDataBase
{

    public ?int $id;
    public ?int $gamer_id;
    public ?int $game_id;
    public ?int $goals;
    public ?int $assists;

    protected array $rules = [
        'gamer_id' => 'required|int|exists:gamers,id',
        'game_id' => 'required|int|exists:games,id',
        'goals' => 'nullable|int',
        'assists' => 'nullable|int',
    ];
}
