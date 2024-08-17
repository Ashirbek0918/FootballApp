<?php
declare(strict_types=1);
namespace App\DataObjects\User;



use Akbarali\DataObject\DataObjectBase;

class AuthDataObject extends DataObjectBase
{
    public ?string $email;
    public ?string $password;
    public ?string $address;

}
