<?php

namespace App\ActionData\Gamers;

use Akbarali\ActionData\ActionDataBase;

class UpdateGamerActionData extends ActionDataBase
{

    public ?int $id ;
    public ?string $name ;
    public ?string $surname ;
    public ?int $age ;
    public ?int $weight;
    public ?int $height;
    public $files;
    public ?int $position_id;
    protected array $rules = [
        'name' => 'required|string',
        'surname' => 'nullable|string',
        'age' => 'required|integer',
        'weight' => 'nullable|integer',
        'height' => 'nullable|integer',
        'position_id' => 'required|integer|exists:positions,id',
        'files' => 'nullable|array',
        'files.*.file' => 'nullable|mimes:jpeg,png,jpg,gif,svg,pdf,doc,docx|max:8192',
    ];
}
