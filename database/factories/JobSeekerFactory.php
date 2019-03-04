<?php

use Faker\Generator as Faker;

$factory->define(App\JobSeeker::class, function (Faker $faker) {
    return [
        'status' => $faker->companySuffix,
        'bio' => $faker->text,
        'position' => $faker->jobTitle,
        'linked_in' => $faker->url,
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});
