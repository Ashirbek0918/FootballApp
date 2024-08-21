<?php

namespace App\Models;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $name
 * @property Day $day_id
 */
class Team extends Model
{
    use HasFactory, EloquentFilterTrait;

    protected $table = 'teams';
    protected $fillable = [
        'day_id',
        'name'
    ];

    public function day(): BelongsTo
    {
        return $this->belongsTo(Day::class);
    }

    public function teamGamers():HasMany
    {
        return $this->hasMany(TeamGamer::class);
    }

    public function games():HasMany
    {
        return $this->hasMany(Game::class);
    }
}
