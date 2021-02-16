<?php

namespace Modules\BookingProduct\Models;

use Modules\Core\Eloquent\TranslatableModel;
use Modules\BookingProduct\Contracts\BookingProductEventTicket as BookingProductEventTicketContract;

class BookingProductEventTicket extends TranslatableModel implements BookingProductEventTicketContract
{
    public $timestamps = false;

    public $translatedAttributes = ['name', 'description'];

    protected $fillable = [
        'price',
        'qty',
        'special_price',
        'special_price_from',
        'special_price_to',
        'booking_product_id',
    ];
}