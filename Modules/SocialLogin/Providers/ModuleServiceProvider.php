<?php

namespace Modules\SocialLogin\Providers;

use Modules\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Modules\SocialLogin\Models\CustomerSocialAccount::class,
    ];
}