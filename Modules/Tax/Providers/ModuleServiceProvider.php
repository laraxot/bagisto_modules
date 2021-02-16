<?php

namespace Modules\Tax\Providers;

use Modules\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Modules\Tax\Models\TaxCategory::class,
        \Modules\Tax\Models\TaxMap::class,
        \Modules\Tax\Models\TaxRate::class,
    ];
}