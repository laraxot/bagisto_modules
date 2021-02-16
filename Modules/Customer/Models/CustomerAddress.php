<?php

namespace Modules\Customer\Models;

use Illuminate\Database\Eloquent\Builder;
use Modules\Core\Models\Address;
use Modules\Customer\Contracts\CustomerAddress as CustomerAddressContract;

class CustomerAddress extends Address implements CustomerAddressContract
{
    public const ADDRESS_TYPE = 'customer';

    /**
     * @var array default values
     */
    protected $attributes = [
        'address_type' => self::ADDRESS_TYPE,
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        static::addGlobalScope('address_type', static function (Builder $builder) {
            $builder->where('address_type', self::ADDRESS_TYPE);
        });

        parent::boot();
    }
}
