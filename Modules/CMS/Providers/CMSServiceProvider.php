<?php

namespace Modules\CMS\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\CMS\Providers\ModuleServiceProvider;

class CMSServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}