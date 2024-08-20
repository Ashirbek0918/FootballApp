<?php

namespace App\ActionData\Day;

use Akbarali\ActionData\ActionDataBase;

class DayActionData extends ActionDataBase
{

    public ?int $id;
    public ?string $day;


    protected array $rules = [
        "day" => "required|date",
    ];
}
