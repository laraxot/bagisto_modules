<?php

namespace Modules\BookingProduct\Listeners;

use Modules\BookingProduct\Repositories\BookingRepository;

class Order
{
    /**
     * BookingRepository Object
     *
     * @var \Modules\BookingProduct\Repositories\BookingRepository
     */
    protected $bookingRepository;

    /**
     * Create a new listener instance.
     *
     * @param  \Modules\Booking\Repositories\BookingRepository  $bookingRepository
     * @return void
     */
    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    /**
     * After sales order creation, add entry to bookings table
     *
     * @param \Modules\Sales\Contracts\Order  $order
     */
    public function afterPlaceOrder($order)
    {
        $this->bookingRepository->create(['order' => $order]);
    }
}