<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Model\Seller;
use App\Model\Transaction;
use App\Model\User;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {

    $seller = Seller::has('products')->get()->random();
    $buyer = User::all()->except($seller->id)->random();

    return [
        'quantity' => $faker->numberBetween(1, 3),
        'buyer_id' => $buyer->id,
        'product_id' => $seller->products->random()->id,
    ];
});
