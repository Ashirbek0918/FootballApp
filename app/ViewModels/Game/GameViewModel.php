<?php

namespace App\ViewModels\Game;

use Akbarali\ViewModel\BaseViewModel;

class GameViewModel extends BaseViewModel
{

    public ?int $id;
    public ?int $home_team_id;
    public ?int $away_team_id;
    public ?int $home_team_score;
    public ?int $away_team_score;
    public $awayTeam;
    public  $homeTeam;
    protected function populate()
    {
        // TODO: Implement populate() method.
    }
}
