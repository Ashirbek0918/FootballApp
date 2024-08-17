<?php

namespace App\Services\Web;

use App\ActionData\User\LoginUserActionData;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{

    public static function login(LoginUserActionData $data):bool
    {
        $user = User::query()->where('email', $data->email)->first();
        if (is_null($user) || !Hash::check($data->password, $user->password)) {
            return false;
        }
        Auth::login($user);
        return true;
    }

}
