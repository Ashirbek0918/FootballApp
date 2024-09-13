<?php

namespace App\ActionData\Day;

use Akbarali\ActionData\ActionDataBase;

class DayActionData extends ActionDataBase
{

    public ?int $id;
    public ?string $day;
    public ?string $content;
    public ?string $time;


    protected array $rules = [
        "day" => "required|date",
        "content" => "required|string",
        "time" => "nullable|string",
    ];
}
