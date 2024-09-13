<?php

namespace App\Models;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Day extends Model
{
    use HasFactory, EloquentFilterTrait;

    protected $fillable = [
        'day',
        'time',
        'content'
    ];

    public function teams():HasMany
    {
        return $this->hasMany(Team::class);
    }
}
