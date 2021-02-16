<?php

namespace Modules\Category\Providers;

use Modules\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Modules\Category\Models\Category::class,
        \Modules\Category\Models\CategoryTranslation::class,
    ];
}