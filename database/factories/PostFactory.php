<?php

use Faker\Generator as Faker;

$factory->define(FiguredBlog\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'body' => $faker->paragraph(),
        'visible_at' => $faker->dateTime()
    ];
});
