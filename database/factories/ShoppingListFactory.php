<?php

use App\User;
use App\ShoppingList;
use Faker\Generator as Faker;

$factory->define(ShoppingList::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'status' => $faker->randomElement([ShoppingList::PENDING, ShoppingList::COMPLETED, ShoppingList::DISCARDED]),
        'user_id'=> User::all()->random(),
    ];
});
