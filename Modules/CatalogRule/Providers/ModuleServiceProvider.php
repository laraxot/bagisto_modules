<?php

namespace Modules\CatalogRule\Providers;

use Modules\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Modules\CatalogRule\Models\CatalogRule::class,
        \Modules\CatalogRule\Models\CatalogRuleProduct::class,
        \Modules\CatalogRule\Models\CatalogRuleProductPrice::class
    ];
}