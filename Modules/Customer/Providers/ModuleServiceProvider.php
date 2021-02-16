<?php

namespace Modules\Customer\Providers;

use Modules\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Modules\Customer\Models\Customer::class,
        \Modules\Customer\Models\CustomerAddress::class,
        \Modules\Customer\Models\CustomerGroup::class,
        \Modules\Customer\Models\Wishlist::class,
    ];
}