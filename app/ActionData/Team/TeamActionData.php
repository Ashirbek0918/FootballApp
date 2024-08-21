<?php

namespace App\ActionData\Team;

use Akbarali\ActionData\ActionDataBase;

class TeamActionData extends ActionDataBase
{

    public ?int $id ;
    public ?string $name ;
    public ?int $day_id;
    public ?array $gamers;

    protected array $rules = [
        'day_id' => 'required|int|exists:days,id',
        'name' => 'required|string',
        'gamers' => 'required|array',
        'gamers.*id' => 'required|int|exists:gamers,id'
    ];
}
