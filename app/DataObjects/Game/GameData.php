<?php

namespace App\DataObjects\Game;

use Akbarali\DataObject\DataObjectBase;
use App\DataObjects\Team\TeamData;

class GameData extends DataObjectBase
{

    public ?int $id;
    public ?int $home_team_id;
    public ?int $away_team_id;
    public ?int $home_team_score;
    public ?int $away_team_score;
    public ?TeamData $awayTeam;
    public ?TeamData $homeTeam;
}
