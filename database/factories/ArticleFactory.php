<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use App\User;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'body' => $faker->word,
        'user_id' => function () {
            return factory(User::class);
        }
    ];
});
