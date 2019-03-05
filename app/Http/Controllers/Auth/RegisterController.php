<?php

namespace App\Http\Controllers\Auth;

use App\Helper\AuthTrait;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Repo\UserRepoTrait;
use Illuminate\Support\Facades\Log;


class RegisterController extends Controller
{
    use UserRepoTrait, AuthTrait;

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
     * @return UserResource
     */
    public function register(RegisterRequest $registerRequest)
    {
        try {
            $newUser = $this->store($registerRequest);
            if (is_null($newUser)) {
                return response(['success' => false, 'body' => 'can not create user'], 419);
            }
            $token = $this->attempt($registerRequest->only('email', 'password'));
            return new UserResource($newUser, $token);
        } catch (\Exception $e) {
            Log::error(['success' => false, 'message' => $e->getMessage()]);
            return response(['success' => false, 'body' => 'can not create user'], 419);
        }

    }
}
