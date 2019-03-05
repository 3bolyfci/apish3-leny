<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class UserResource extends JsonResource
{
    /*
     * @todo take token and refresh token
    **/
    private $token;

    public function __construct($resource, $token)
    {
        parent::__construct($resource);
        $this->token = $token;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        try {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                $this->mergeWhen(!is_null($this->token), function () {
                    return [
                        'token' => $this->token
                    ];
                })
            ];
        } catch (\Exception $exception) {
            Log::info(['success' => false, 'message' => $exception->getMessage()]);
        }

    }
}
