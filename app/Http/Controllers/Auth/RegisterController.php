<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Controllers\Controller;
use App\Repo\UserRepoTrait;
use App\User;


class RegisterController extends Controller
{
    use UserRepoTrait;

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    /**
     * @todo register new user in system and return his with token and refresh token
     * @param RegisterRequest $registerRequest
     * @return User
     */
    public function register(RegisterRequest $registerRequest)
    {
        $newUser = $this->store($registerRequest);
        if (is_null($newUser)) {
            return response();
        }
        $token = $this->attempt($registerRequest->only('email', 'password'));
        $refreshToken = $this->refreshToken($token);
        return response(['token'=>$token,'refreshToken'=>$refreshToken]);
    }
}
