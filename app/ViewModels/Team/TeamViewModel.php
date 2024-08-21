<?php

namespace App\ViewModels\Team;

use Akbarali\ViewModel\BaseViewModel;
use App\DataObjects\Day\DayData;
use App\ViewModels\Day\DayViewModel;

class TeamViewModel extends BaseViewModel
{

    public int $id;
    public int $day_id;
    public string $name;
    public  $teamGamers  = [];
    protected function populate():void
    {
    }
}
