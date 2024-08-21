<?php

namespace App\Filters\Gamer;

use App\Filters\EloquentFilterContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class GamerFilter implements EloquentFilterContract
{
    public function __construct(
        protected Request $request
    )
    {
    }
    public function applyEloquent(Builder $model): Builder
    {
        if ($this->request->has('position_id') && $this->request->get('position_id')) {
            $model->where('position_id', $this->request->get('day_id'));
        }
        if($this->request->has('search') && $this->request->get('search')) {
            $model->whereAny([
                'name',
            ],'LIKE', '%' . $this->request->get('search') . '%');

        }
        return $model;
    }

    public static function getRequest(Request $request): static
    {
        return new static($request);
    }
}
