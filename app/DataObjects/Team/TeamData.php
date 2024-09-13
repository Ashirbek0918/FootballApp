<?php
declare(strict_types=1);
namespace App\DataObjects\Team;

use Akbarali\DataObject\DataObjectBase;
use App\DataObjects\Day\DayData;
use App\DataObjects\Game\GamerGameStatData;

class TeamData extends DataObjectBase
{

    public int $id;
    public int $day_id;
    public string $name;
    public  array|TeamGamerData $teamGamers;
}
