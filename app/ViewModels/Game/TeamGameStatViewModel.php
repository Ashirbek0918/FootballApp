<?php

namespace App\ViewModels\Game;

use Akbarali\ViewModel\BaseViewModel;

class TeamGameStatViewModel extends BaseViewModel
{
    public ?int $id;
    public ?int $team_id;
    public ?int $game_id;
    public ?bool $won;
    public ?bool $lost;
    public ?bool $draw;

    protected function populate()
    {
        // TODO: Implement populate() method.
    }
}
