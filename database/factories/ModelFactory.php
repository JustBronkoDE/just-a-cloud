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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'api_token' => str_random(60),
        'description' => 'Hi I\'m a test User',
        'public' => true, //rand(0,1) == 1,
        'profile_pic' => '/defaults/profiles/images/default_'. random_int(1, 3) .'.png'
    ];
});

$factory->define(App\File::class, function (Faker\Generator $faker) {

    $fileName = str_random(10) . '.' . $faker->fileExtension;

    return [
        'user_id' => random_int(1, 50),
        'name' => $fileName,
        'path' => "/fake/" . $fileName,
        'public' => true,
        'type' => 'image'
    ];
});
