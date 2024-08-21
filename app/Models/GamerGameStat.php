<?php

namespace App\Models;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class GamerGameStat extends Model
{
    use HasFactory,EloquentFilterTrait;

    protected $table = 'gamer_game_stats';

    protected $fillable = [
        'gamer_id',
        'game_id',
        'goals',
        'assists'
    ];
}
