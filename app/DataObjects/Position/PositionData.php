<?php

namespace App\DataObjects\Position;

use Akbarali\DataObject\DataObjectBase;

class PositionData extends DataObjectBase
{

    public int $id;
    public string $name;
    public $gamers;
}
