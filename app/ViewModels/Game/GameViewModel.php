<?php

namespace App\ViewModels\Game;

use Akbarali\ViewModel\BaseViewModel;
use App\ViewModels\Team\TeamViewModel;

class GameViewModel extends BaseViewModel
{

    public ?int $id;
    public ?int $day_id;
    public ?int $home_team_id;
    public ?int $away_team_id;
    public ?int $home_team_score;
    public ?int $away_team_score;
    public $awayTeam;
    public  $homeTeam;
    protected function populate()
    {
        $this->homeTeam = TeamViewModel::fromDataObject($this->homeTeam);
        $this->awayTeam = TeamViewModel::fromDataObject($this->awayTeam);
    }
}
