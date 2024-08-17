<?php

namespace App\Models;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $path
 * @property string $type
 * @property string $fileable_id
 * @property float $size
 */
class File extends Model
{
    use HasFactory, EloquentFilterTrait;

    protected $fillable = [
        'path',
        'size',
        'type',
    ];
}
