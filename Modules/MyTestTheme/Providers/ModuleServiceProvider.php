<?php

namespace Modules\MyTestTheme\Providers;

use Modules\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Modules\myTestTheme\Models\Category::class,
        \Modules\myTestTheme\Models\Content::class,
        \Modules\myTestTheme\Models\ContentTranslation::class,
        \Modules\myTestTheme\Models\OrderBrand::class,
        \Modules\myTestTheme\Models\myTestThemeCustomerCompareProduct::class,
        \Modules\myTestTheme\Models\myTestThemeMetadata::class,
    ];
}