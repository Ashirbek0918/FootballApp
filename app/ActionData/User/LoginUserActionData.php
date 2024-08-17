<?php
declare(strict_types=1);
namespace App\ActionData\User;

use Akbarali\ActionData\ActionDataBase;

class LoginUserActionData extends ActionDataBase
{
    public string $email;
    public string $password;

    protected array $roles = [
        'email' => 'required|exists:users,email',
        'password' => 'required|string',
    ];
}
