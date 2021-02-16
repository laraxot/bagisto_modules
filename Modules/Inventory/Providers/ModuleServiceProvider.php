<?php

namespace Modules\Inventory\Providers;

use Modules\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Modules\Inventory\Models\InventorySource::class,
    ];
}