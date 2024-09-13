<?php

namespace App\ActionData\Game;

use Akbarali\ActionData\ActionDataBase;

class GameUpdateActionData extends ActionDataBase
{
    public ?int $home_team_score = 0;
    public ?int $away_team_score = 0;
    public ?array $gamers;
    protected array $rules = [
        'home_team_score' => 'required',
        'away_team_score' => 'required',
    ];

}
