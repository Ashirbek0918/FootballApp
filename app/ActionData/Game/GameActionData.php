<?php

namespace App\ActionData\Game;

use Akbarali\ActionData\ActionDataBase;

class GameActionData extends ActionDataBase
{
    public ?int $id;
    public ?int $day_id;
    public ?int $home_team_id;
    public ?int $away_team_id;
    public ?int $home_team_score = 0;
    public ?int $away_team_score = 0;

    protected array $rules = [
        'day_id' => 'required|int|exists:days,id',
        'home_team_id' => 'required|int|exists:teams,id',
        'away_team_id' => 'required|int|exists:teams,id',
        'home_team_score' => 'nullable|int',
        'away_team_score' => 'nullable|int',
    ];
}
