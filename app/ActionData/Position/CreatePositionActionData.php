<?php

namespace App\ActionData\Position;

use Akbarali\ActionData\ActionDataBase;

class CreatePositionActionData extends ActionDataBase
{

    public ?string $name;

    protected array $rules = [
        'name' => 'required|string'
    ];
}
