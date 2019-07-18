<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use Faker\Generator;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'role_id' => $faker->numberBetween(1, 3),
        'is_active' => $faker->numberBetween(0, 1),

    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'content' => $faker->paragraph,
        'photo_id' => 1,
        'category_id' => $faker->numberBetween(1, 8),
        'slug' => $faker->slug(),

    ];
});

$factory->define(App\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->randomElement(['administrator', 'author', 'subscriber']),


    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->randomElement(['PHP', 'Javascript', 'Bootstrap', 'Laravel', 'Data Science', 'Machine Learning', 'Artificial Intelligence', 'Cyber Security'])


    ];
});

$factory->define(App\Photo::class, function (Faker\Generator $faker) {
    return [
        'path' => 'placeholder.jpg'


    ];
});