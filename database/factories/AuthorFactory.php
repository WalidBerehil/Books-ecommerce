<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Author;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Author::class, function (Faker $faker) {
    $name = $faker->sentence();
    return [
        //
        "name" => $name,
        "slug" => Str::slug($name)
    ];
});
