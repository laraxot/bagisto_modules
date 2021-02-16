<?php

namespace Modules\User\Providers;

use Modules\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Modules\User\Models\Admin::class,
        \Modules\User\Models\Role::class,
    ];
}