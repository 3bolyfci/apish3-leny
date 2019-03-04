<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Repo\UserRepoTrait;
use Facades\Tymon\JWTAuth\JWTAuth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use UserRepoTrait;

    public function login(LoginRequest $loginRequest)
    {

        $token = $this->attempt($loginRequest->only('email', 'password'));
        return $currentUser =JWTAuth::toUser($token);
;
    }
}
