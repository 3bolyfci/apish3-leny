<?php

namespace App\Helper;

use Facades\Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Log;

/**
 * Created by Ahmed abdelAal.
 * User: Code95
 * Date: 3/5/2019
 * Time: 11:25 AM
 */
trait AuthTrait
{
    /**
     * @todo take array of credentials and attempt
     * @param array $credentials
     * @return mixed
     */
    protected function attempt(array $credentials)
    {
        try {
            return JWTAuth::attempt($credentials);
        } catch (\Exception $exception) {
            Log::error(['method' => __METHOD__, 'message' => $exception->getMessage(), 'exception' => ($exception->getTraceAsString())]);
            return null;
        }

    }

    /**
     * @param $token
     * @return null or App\User
     */
    protected function getCurrentUser($token)
    {
        try {
            return JWTAuth::toUser($token);
        } catch (\Exception $exception) {
            Log::error(['method' => __METHOD__, 'message' => $exception->getMessage(), 'exception' => ($exception->getTraceAsString())]);
            return null;
        }
    }

    /**
     * @todo take token and generate refresh token for it
     * @param $token
     * @return mixed
     */
    protected function refreshToken($token)
    {
        try {
            return JWTAuth::refresh($token);
        } catch (\Exception $exception) {
            Log::error(['method' => __METHOD__, 'message' => $exception->getMessage(), 'exception' => ($exception->getTraceAsString())]);
            return null;
        }

    }

    protected function token()
    {
        try {
            return JWTAuth::getToken();
        } catch (\Exception $exception) {
            Log::error(['method' => __METHOD__, 'message' => $exception->getMessage(), 'exception' => ($exception->getTraceAsString())]);
            return null;
        }
    }


}