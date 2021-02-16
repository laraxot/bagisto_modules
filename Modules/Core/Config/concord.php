<?php

return [

    'convention' => Webkul\Core\CoreConvention::class,

    'modules' => [
        /**
         * Example:
         * VendorA\ModuleX\Providers\ModuleServiceProvider::class,
         * VendorB\ModuleY\Providers\ModuleServiceProvider::class
         *
         */

        \Modules\Admin\Providers\ModuleServiceProvider::class,
        \Modules\API\Providers\ModuleServiceProvider::class,
        \Modules\Attribute\Providers\ModuleServiceProvider::class,
        \Modules\BookingProduct\Providers\ModuleServiceProvider::class,
        \Modules\CartRule\Providers\ModuleServiceProvider::class,
        \Modules\CatalogRule\Providers\ModuleServiceProvider::class,
        \Modules\Category\Providers\ModuleServiceProvider::class,
        \Modules\Checkout\Providers\ModuleServiceProvider::class,
        \Modules\Core\Providers\ModuleServiceProvider::class,
        \Modules\CMS\Providers\ModuleServiceProvider::class,
        \Modules\Customer\Providers\ModuleServiceProvider::class,
        \Modules\Inventory\Providers\ModuleServiceProvider::class,
        \Modules\Marketing\Providers\ModuleServiceProvider::class,
        \Modules\Payment\Providers\ModuleServiceProvider::class,
        \Modules\Paypal\Providers\ModuleServiceProvider::class,
        \Modules\Product\Providers\ModuleServiceProvider::class,
        \Modules\Rule\Providers\ModuleServiceProvider::class,
        \Modules\Sales\Providers\ModuleServiceProvider::class,
        \Modules\Shipping\Providers\ModuleServiceProvider::class,
        \Modules\Shop\Providers\ModuleServiceProvider::class,
        \Modules\SocialLogin\Providers\ModuleServiceProvider::class,
        \Modules\Tax\Providers\ModuleServiceProvider::class,
        \Modules\Theme\Providers\ModuleServiceProvider::class,
        \Modules\Ui\Providers\ModuleServiceProvider::class,
        \Modules\User\Providers\ModuleServiceProvider::class,
        \Modules\Velocity\Providers\ModuleServiceProvider::class,
    ]
];