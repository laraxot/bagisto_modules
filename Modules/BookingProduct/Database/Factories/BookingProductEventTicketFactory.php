<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Modules\BookingProduct\Models\BookingProduct;
use Modules\BookingProduct\Models\BookingProductEventTicket;

$factory->define(BookingProductEventTicket::class, static function (Faker $faker, array $attributes) {
    return [
        'price'              => $faker->randomFloat(4, 3, 900),
        'qty'                => $faker->numberBetween(100, 1000),
        'booking_product_id' => static function () {
            return factory(BookingProduct::class)->create(['type' => 'event'])->id;
        }
    ];
});