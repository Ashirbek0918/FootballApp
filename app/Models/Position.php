<?php

namespace App\Models;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $name
 */
class Position extends Model
{
    use HasFactory , EloquentFilterTrait;


    protected $fillable = [
        'name'
    ];

    public function gamers():HasMany
    {
        return $this->hasMany(Gamer::class);
    }
}
