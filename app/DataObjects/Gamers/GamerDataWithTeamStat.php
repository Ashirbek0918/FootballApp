<?php

namespace App\DataObjects\Gamers;

use Akbarali\DataObject\DataObjectBase;
use App\DataObjects\Game\GamerGameStatData;
use App\DataObjects\Position\PositionData;

class GamerDataWithTeamStat extends DataObjectBase
{
    public int $id ;
    public string $name ;
    public ?string $surname ;
    public int $age ;
    public ?int $weight;
    public ?int $height;
    public int $position_id;
    public array|GamerGameStatData $gameStats;
    public ?PositionData $position;
    public ?array $files;
    public ?string $created_at;

}
