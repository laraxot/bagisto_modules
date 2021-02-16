<?php

namespace Modules\Core\Models;

use Modules\Core\Eloquent\TranslatableModel;
use Modules\Core\Contracts\Country as CountryContract;

class Country extends TranslatableModel implements CountryContract
{
    public $timestamps = false;

    public $translatedAttributes = ['name'];

    protected $with = ['translations'];
}