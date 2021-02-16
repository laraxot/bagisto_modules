<?php

namespace Modules\Attribute\Providers;

use Modules\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Modules\Attribute\Models\Attribute::class,
        \Modules\Attribute\Models\AttributeFamily::class,
        \Modules\Attribute\Models\AttributeGroup::class,
        \Modules\Attribute\Models\AttributeOption::class,
        \Modules\Attribute\Models\AttributeOptionTranslation::class,
        \Modules\Attribute\Models\AttributeTranslation::class,
    ];
}