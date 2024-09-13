<?php

namespace App\DataObjects\Day;

use Akbarali\DataObject\DataObjectBase;

class DayData extends DataObjectBase
{

    public int $id;
    public string $day;
    public ?string $content;
    public ?string $time;
    public $teams_count = 0;
}
