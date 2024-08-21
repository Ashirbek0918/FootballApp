<?php

namespace App\DataObjects\Game;

use Akbarali\DataObject\DataObjectBase;

class TeamGameStatData extends DataObjectBase
{

    public ?int $id;
    public ?int $team_id;
    public ?int $game_id;
    public ?bool $won;
    public ?bool $lost;
    public ?bool $draw;
}
