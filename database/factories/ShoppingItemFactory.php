<?php

use App\Product;
use App\ShoppingList;
use Faker\Generator as Faker;

$factory->define(App\ShoppingItem::class, function (Faker $faker) {
    return [
        'quantity' => $faker->numberBetween(1, 10),
        'price' => $faker->randomFloat(2, 1, 99.99),
        'shopping_list_id'=> ShoppingList::all()->random(),
        'product_id'=> Product::all()->random(),
    ];
});
