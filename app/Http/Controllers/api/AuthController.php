<?php

namespace App\Http\Controllers\api;

use App\DataObjects\User\UserData;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user or !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => "Invalid password or email",
            ], 403);
        }
        $token = $user->createToken('user')->plainTextToken;
        return response()->json([
            'success' => true,
            'token' => $token
        ]);
    }
    public  function getme(){
        $user = User::query()->findOrFail(auth()->user()->id);
        return response()->json([
            'success' => true,
            'data' => UserData::fromModel($user)
        ]);
    }
}
