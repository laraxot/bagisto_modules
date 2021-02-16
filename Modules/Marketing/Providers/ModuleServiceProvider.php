<?php

namespace Modules\Marketing\Providers;

use Modules\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Modules\Marketing\Models\Campaign::class,
        \Modules\Marketing\Models\Template::class,
        \Modules\Marketing\Models\Event::class,
    ];
}