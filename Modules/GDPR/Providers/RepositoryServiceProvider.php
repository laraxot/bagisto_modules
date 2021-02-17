<?php

namespace Modules\GDPR\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class RepositoryServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Modules\GDPR\Models\GDPR::class,
        \Modules\GDPR\Models\GDPRDataRequest::class,
        
    ];
}