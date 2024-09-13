<?php

namespace App\DataObjects\User;

use Akbarali\DataObject\DataObjectBase;

class UserData extends DataObjectBase
{

    public ?int $id = null;
    public ?string $email;
    public ?string $address;
}
