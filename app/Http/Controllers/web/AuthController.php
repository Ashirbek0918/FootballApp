<?php

namespace App\Http\Controllers\web;

use App\ActionData\User\LoginUserActionData;
use App\Http\Controllers\Controller;
use App\Services\Web\AuthService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function __construct(
        protected AuthService $service,
    )
    {
    }

    public function index(): View|RedirectResponse
    {
        if (auth()->check()) {
            return redirect()->route('dashboard.home');
        }
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        if (auth()->check()) {
            return redirect()->route('dashboard.home')->with('res', [
                'method' => 'success',
                'msg' => trans('messages.auth.success')
            ]);
        }
        try {
            $authDataObject = $this->service->login(LoginUserActionData::createFromRequest($request));
            return to_route('dashboard.home')->with('res', [
                'method' => 'success',
                'msg' => trans('messages.auth.success')
            ]);
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
