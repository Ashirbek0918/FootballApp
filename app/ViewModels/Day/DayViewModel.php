<?php

namespace App\ViewModels\Day;

use Akbarali\ViewModel\BaseViewModel;
use Carbon\Carbon;

class DayViewModel extends BaseViewModel
{

    public int $id;
    public string $day;
    public ?string $content;
    public ?string $time;

    public $teams_count;
    protected function populate()
    {
//        $this->day = Carbon::parse($this->day)->format('d-m-y');
    }
}
