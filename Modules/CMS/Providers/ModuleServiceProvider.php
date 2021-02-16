<?php

namespace Modules\CMS\Providers;

use Modules\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Modules\CMS\Models\CmsPage::class,
        \Modules\CMS\Models\CmsPageTranslation::class
    ];
}