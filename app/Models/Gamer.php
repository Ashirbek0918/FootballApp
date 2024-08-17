<?php

namespace App\Models;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;


/**
 * @property string $name
 * @property string $surname
 * @property int $weight
 * @property int $age
 * @property int $height
 * @property int $position_id
 */
class Gamer extends Model
{
    use HasFactory, EloquentFilterTrait;

    protected $fillable = [
        'name',
        'surname',
        'weight',
        'age',
        'height',
        'position_id',
    ];

    public function position():BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function files():MorphMany
    {
        return $this->morphMany(File::class,'fileable');
    }
}
