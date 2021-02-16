<?php

namespace Modules\BookingProduct\Providers;

use Modules\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Modules\BookingProduct\Models\BookingProduct::class,
        \Modules\BookingProduct\Models\BookingProductDefaultSlot::class,
        \Modules\BookingProduct\Models\BookingProductAppointmentSlot::class,
        \Modules\BookingProduct\Models\BookingProductEventTicket::class,
        \Modules\BookingProduct\Models\BookingProductEventTicketTranslation::class,
        \Modules\BookingProduct\Models\BookingProductRentalSlot::class,
        \Modules\BookingProduct\Models\BookingProductTableSlot::class,
        \Modules\BookingProduct\Models\Booking::class,
    ];
}