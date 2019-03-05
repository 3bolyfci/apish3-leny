<?php

namespace App\Repo;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


trait UserRepoTrait
{
    /**
     * @param Request $request
     * @return User|null
     */
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
     * @param User $user
     * @param Request $request
     * @return User|null
     */
    protected function reset(User $user, Request $request)
    {
        DB::beginTransaction();

        try {
            $user->password = Hash::make($request->password);
            $user->save();
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollback();
            return null;
        }
    }

    protected function delete(collection $collection)
    {

    }


}