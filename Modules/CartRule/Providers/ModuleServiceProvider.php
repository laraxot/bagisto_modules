<?php

namespace Modules\CartRule\Providers;

use Modules\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Modules\CartRule\Models\CartRule::class,
        \Modules\CartRule\Models\CartRuleTranslation::class,
        \Modules\CartRule\Models\CartRuleCustomer::class,
        \Modules\CartRule\Models\CartRuleCoupon::class,
        \Modules\CartRule\Models\CartRuleCouponUsage::class
    ];
}