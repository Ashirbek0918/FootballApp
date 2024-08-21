<?php

namespace App\Filters\Team;

use App\Filters\EloquentFilterContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TeamFilter implements EloquentFilterContract
{

    public function __construct(
        protected Request $request
    )
    {
    }
    public function applyEloquent(Builder $model): Builder
    {
        if ($this->request->has('day_id') && $this->request->get('day_id')) {
            $model->where('day_id', $this->request->get('day_id'));
        }
        return $model;
    }

    public static function getRequest(Request $request): static
    {
        return new static($request);
    }
}
