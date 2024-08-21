<?php

namespace App\Models;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Team $team_id
 * @property Game $game_id
 * @property bool $won
 * @property bool $lost
 * @property bool $draw
 */
class TeamGameStat extends Model
{
    use HasFactory, EloquentFilterTrait;

    protected $fillable = [
        'team_id',
        'game_id',
        'won',
        'lost',
        'draw'
    ];

}
