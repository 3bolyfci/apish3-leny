<?php

namespace App\Http\Controllers\Auth;

use App\Helper\AuthTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Resources\User\UserResource;
use App\Repo\UserRepoTrait;
use Illuminate\Support\Facades\Log;


class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    use AuthTrait, UserRepoTrait;

    /**
     * @param ResetPasswordRequest $request
     * @return mixed
     * @throws \Throwable
     */
    protected function resetPassword(ResetPasswordRequest $request)
    {
        try {
            $token = $this->token();
            $user = $this->getCurrentUser($token);
            $updatedUser = $this->reset($user, $request);
            throw_if(is_null($updatedUser), \Exception::class);
            return new UserResource($updatedUser, null);
        } catch (\Exception $exception) {
            Log::error(['method' => __METHOD__, 'message' => $exception->getMessage(), 'exception' => ($exception->getTraceAsString())]);
            return response(['success' => false, 'message' => 'can not reset password'], $exception->getStatusCode());
        }


    }
}
