<?php

namespace Modules\Paypal\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Modules\Theme\ViewRenderEventManager;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {   
        Event::listen('bagisto.shop.layout.body.after', static function(ViewRenderEventManager $viewRenderEventManager) {
            $viewRenderEventManager->addTemplate('paypal::checkout.onepage.paypal-smart-button');
        });
    }
}