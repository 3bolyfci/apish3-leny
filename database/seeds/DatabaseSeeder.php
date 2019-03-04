<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(App\User::class, 5)->create();
        $users->each(function ($user) {
            $user->jobSeeker()->save(factory(App\JobSeeker::class)->make());
        });
    }
}
