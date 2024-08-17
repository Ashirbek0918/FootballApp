<?php

namespace App\DataObjects\Gamers;

use Akbarali\DataObject\DataObjectBase;
use App\DataObjects\Position\PositionData;
use Carbon\Carbon;

class GamerData extends DataObjectBase
{
    public int $id ;
    public string $name ;
    public ?string $surname ;
    public int $age ;
    public ?int $weight;
    public ?int $height;
    public int $position_id;
    public ?PositionData $position;
    public $files;
    public string $created_at;
}
