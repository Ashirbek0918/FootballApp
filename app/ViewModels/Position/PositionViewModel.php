<?php

namespace App\ViewModels\Position;

use Akbarali\ViewModel\BaseViewModel;

class PositionViewModel extends BaseViewModel
{
    public int $id;
    public string $name;
    public $gamers = [];

    protected function populate():void
    {
        $this->gamers = count($this->gamers);
    }
}
