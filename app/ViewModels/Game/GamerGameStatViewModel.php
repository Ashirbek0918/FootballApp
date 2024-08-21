<?php

namespace App\ViewModels\Game;

use Akbarali\ViewModel\BaseViewModel;

class GamerGameStatViewModel extends BaseViewModel
{

    public ?int $id;
    public ?int $gamer_id;
    public ?int $game_id;
    public ?int $goals;
    public ?int $assists;

    protected function populate()
    {
        // TODO: Implement populate() method.
    }
}
