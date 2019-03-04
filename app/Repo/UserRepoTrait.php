<?php

namespace App\Repo;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Facades\Tymon\JWTAuth\JWTAuth;

trait UserRepoTrait
{
    protected function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $user = User::create([
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'email' => $request->email,
            ]);
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollback();
            return null;
        }
    }

    /**
     * @todo take array of credentials and attempt
     * @param array $credentials
     * @return mixed
     */
    protected function attempt(array $credentials)
    {
        return JWTAuth::attempt($credentials);
    }
    protected function update(User $user, Request $request)
    {

    }

    protected function delete(collection $collection)
    {

    }


}