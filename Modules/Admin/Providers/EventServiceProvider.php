<?php

namespace Modules\Admin\Providers;

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
        Event::listen('user.admin.update-password', 'Modules\Admin\Listeners\PasswordChange@sendUpdatePasswordMail');

        Event::listen('checkout.order.save.after', 'Modules\Admin\Listeners\Order@sendNewOrderMail');

        Event::listen('sales.invoice.save.after', 'Modules\Admin\Listeners\Order@sendNewInvoiceMail');

        Event::listen('sales.shipment.save.after', 'Modules\Admin\Listeners\Order@sendNewShipmentMail');

        Event::listen('sales.order.cancel.after', 'Modules\Admin\Listeners\Order@sendCancelOrderMail');

        Event::listen('sales.refund.save.after', 'Modules\Admin\Listeners\Order@refundOrder');

        Event::listen('sales.refund.save.after', 'Modules\Admin\Listeners\Order@sendNewRefundMail');

        Event::listen('sales.order.comment.create.after', 'Modules\Admin\Listeners\Order@sendOrderCommentMail');

        Event::listen('core.channel.update.after', 'Modules\Admin\Listeners\ChannelSettingsChange@checkForMaintenaceMode');
    }
}