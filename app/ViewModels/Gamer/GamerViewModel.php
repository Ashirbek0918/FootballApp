<?php

namespace App\ViewModels\Gamer;

use Akbarali\ViewModel\BaseViewModel;
use Carbon\Carbon;

class GamerViewModel extends BaseViewModel
{

    public int $id ;
    public string $name ;
    public ?string $surname ;
    public int $age ;
    public ?int $weight;
    public ?int $height;
    public int $position_id;
    public $files;
    public string $created_at;
    public $position;
    public $file = null;
    protected function populate():void
    {
        $this->created_at = Carbon::parse($this->created_at)->format('d-m-Y');
        $this->file = $this->files[0];
    }
}
