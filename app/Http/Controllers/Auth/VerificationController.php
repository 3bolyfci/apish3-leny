<?php

namespace App\Http\Controllers\Auth;

use App\Helper\AuthTrait;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails, AuthTrait;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function verify(Request $request)
    {
        try {
            $token = $this->token();
            $user = $this->getCurrentUser($token);
            if ($user->hasVerifiedEmail()) {
                return response(['success' => false, 'body' => 'email has been verified before'], 200);
            }
            if ($user->markEmailAsVerified()) {
                event(new Verified($user));
            }
            return response(['success' => true, 'body' => 'email verified'], 200);
        } catch (\Exception $exception) {
            Log::error(['method' => __METHOD__, 'message' => $exception->getMessage(), 'exception' => ($exception->getTraceAsString())]);
            return response(['success' => false, 'message' => 'can not verify account'], $exception->getStatusCode());
        }

    }

}
