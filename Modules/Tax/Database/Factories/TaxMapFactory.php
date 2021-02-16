<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Modules\Tax\Models\TaxMap;
use Modules\Tax\Models\TaxRate;
use Modules\Tax\Models\TaxCategory;

$factory->define(TaxMap::class, function (Faker $faker) {
    return [
        'tax_category_id' => function () {
            return factory(TaxCategory::class)->create()->id;
        },
        'tax_rate_id' => function () {
            return factory(TaxRate::class)->create()->id;
        },
    ];
});
