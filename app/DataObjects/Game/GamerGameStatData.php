<?php

namespace App\DataObjects\Game;

use Akbarali\DataObject\DataObjectBase;

class GamerGameStatData extends DataObjectBase
{

    public ?int $id;
    public ?int $gamer_id;
    public ?int $game_id;
    public ?int $goals;
    public ?int $assists;

}
