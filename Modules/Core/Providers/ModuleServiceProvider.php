<?php

namespace Modules\Core\Providers;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Modules\Core\Models\Channel::class,
        \Modules\Core\Models\CoreConfig::class,
        \Modules\Core\Models\Country::class,
        \Modules\Core\Models\CountryTranslation::class,
        \Modules\Core\Models\CountryState::class,
        \Modules\Core\Models\CountryStateTranslation::class,
        \Modules\Core\Models\Currency::class,
        \Modules\Core\Models\CurrencyExchangeRate::class,
        \Modules\Core\Models\Locale::class,
        \Modules\Core\Models\Slider::class,
        \Modules\Core\Models\SubscribersList::class,
    ];
}