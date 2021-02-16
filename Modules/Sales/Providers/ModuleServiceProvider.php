<?php

namespace Modules\Sales\Providers;

use Modules\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Modules\Sales\Models\Order::class,
        \Modules\Sales\Models\OrderItem::class,
        \Modules\Sales\Models\DownloadableLinkPurchased::class,
        \Modules\Sales\Models\OrderAddress::class,
        \Modules\Sales\Models\OrderPayment::class,
        \Modules\Sales\Models\OrderComment::class,
        \Modules\Sales\Models\Invoice::class,
        \Modules\Sales\Models\InvoiceItem::class,
        \Modules\Sales\Models\Shipment::class,
        \Modules\Sales\Models\ShipmentItem::class,
        \Modules\Sales\Models\Refund::class,
        \Modules\Sales\Models\RefundItem::class,
    ];
}