<?php

namespace App\Models;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property Day $day_id
 * @property integer $home_tem_id
 * @property integer $away_team_id
 * @property integer $home_team_score
 * @property integer $away_team_score
 */
class Game extends Model
{
    use HasFactory, EloquentFilterTrait;
    protected $table = 'games';

    protected $fillable = [
        'day_id',
        'home_team_id',
        'away_team_id',
        'home_team_score',
        'away_team_score'
    ];

    public  function teamsStats():HasMany
    {
        return $this->hasMany(TeamGameStat::class,'game_id');
    }

    public function awayTeam():BelongsTo
    {
        return $this->belongsTo(Team::class,'away_team_id','id');
    }

    public function homeTeam():BelongsTo
    {
        return $this->belongsTo(Team::class,'home_team_id','id');
    }

    public function gameStats():HasMany
    {
        return $this->hasMany(GamerGameStat::class);
    }

}
