<?php

namespace App\DataObjects\Day;

use Akbarali\DataObject\DataObjectBase;

class DayData extends DataObjectBase
{

    public int $id;
    public string $day;
    public $teams_count;
}
