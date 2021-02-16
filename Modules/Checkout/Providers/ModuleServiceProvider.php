<?php

namespace Modules\Checkout\Providers;

use Modules\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Modules\Checkout\Models\Cart::class,
        \Modules\Checkout\Models\CartAddress::class,
        \Modules\Checkout\Models\CartItem::class,
        \Modules\Checkout\Models\CartPayment::class,
        \Modules\Checkout\Models\CartShippingRate::class,
    ];
}