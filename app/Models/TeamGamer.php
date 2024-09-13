<?php

namespace App\Models;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $team_id
 * @property int $gamer_id
 */
class TeamGamer extends Model
{
    use HasFactory , EloquentFilterTrait;


    protected $fillable = [
        'team_id',
        'gamer_id'
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
    public function gamer(): BelongsTo
    {
        return $this->belongsTo(Gamer::class);
    }


}
