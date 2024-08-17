<?php

namespace App\ActionData\Position;

use Akbarali\ActionData\ActionDataBase;

class CreatePositionActionData extends ActionDataBase
{

    public ? int $id ;
    public ?string $name;

    protected array $rules = [
        'name' => 'required|string|unique:positions,name'
    ];
}
