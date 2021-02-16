<?php

namespace Modules\CartRule\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen('checkout.order.save.after', 'Modules\CartRule\Listeners\Order@manageCartRule');

        Event::listen('checkout.cart.collect.totals.before', 'Modules\CartRule\Listeners\Cart@applyCartRules');
    }
}