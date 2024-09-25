<?php

namespace App\ActionData\Day;

use Akbarali\ActionData\ActionDataBase;

class DaySelectActionData extends ActionDataBase
{

    public int $day_id;

    protected array $rules = [
        'day_id' => 'required|int|exists:days,id'
    ];
}
