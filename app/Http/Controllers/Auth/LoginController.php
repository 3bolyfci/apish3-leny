<?php

namespace App\Http\Controllers\Auth;

use App\Helper\AuthTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\User\UserResource;
use Facades\Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Log;

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
    use AuthTrait;

    /**
     * @param LoginRequest $loginRequest
     * @return mixed
     * @throws \Throwable
     */
    public function login(LoginRequest $loginRequest)
    {
        try {
            $token = $this->attempt($loginRequest->only('email', 'password'));
            throw_if(is_null($token), \Exception::class);
            $currentUser = JWTAuth::toUser($token);
            return new UserResource($currentUser, $token);
        } catch (\Exception $exception) {
            Log::error(['method' => __METHOD__, 'message' => $exception->getMessage(), 'exception' => ($exception->getTraceAsString())]);
            return response(['success' => false, 'message' => 'invalid credentials'], $exception->getStatusCode());
        }

    }
}
