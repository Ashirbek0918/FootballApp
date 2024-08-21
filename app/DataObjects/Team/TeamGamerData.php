<?php

namespace App\DataObjects\Team;

use Akbarali\DataObject\DataObjectBase;
use App\DataObjects\Gamers\GamerData;

class TeamGamerData extends DataObjectBase
{

    public ?int $id;
    public ?int $gamer_id;
    public ?int $team_id;
    public ?GamerData $gamer;
}
