<?php

namespace Modules\Velocity\Providers;

use Modules\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Modules\Velocity\Models\Category::class,
        \Modules\Velocity\Models\Content::class,
        \Modules\Velocity\Models\ContentTranslation::class,
        \Modules\Velocity\Models\OrderBrand::class,
        \Modules\Velocity\Models\VelocityCustomerCompareProduct::class,
        \Modules\Velocity\Models\VelocityMetadata::class,
    ];
}