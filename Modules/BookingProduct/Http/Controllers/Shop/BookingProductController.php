<?php

namespace Modules\BookingProduct\Http\Controllers\Shop;

use Modules\BookingProduct\Repositories\BookingProductRepository;
use Modules\BookingProduct\Helpers\DefaultSlot as DefaultSlotHelper;
use Modules\BookingProduct\Helpers\AppointmentSlot as AppointmentSlotHelper;
use Modules\BookingProduct\Helpers\RentalSlot as RentalSlotHelper;
use Modules\BookingProduct\Helpers\EventTicket as EventTicketHelper;
use Modules\BookingProduct\Helpers\TableSlot as TableSlotHelper;

class BookingProductController extends Controller
{
    /**
     * @return array
     */
    protected $bookingHelpers = [];

    /**
     * Create a new helper instance.
     *
     * @param  \Modules\BookingProduct\Repositories\BookingProductRepository  $bookingProductRepository
     * @param  \Modules\BookingProduct\Helpers\DefaultSlot                    $defaultSlotHelper
     * @param  \Modules\BookingProduct\Helpers\AppointmentSlot                $appointmentSlotHelper
     * @param  \Modules\BookingProduct\Helpers\RentalSlot                     $rentalSlotHelper
     * @param  \Modules\BookingProduct\Helpers\EventTicket                    $EventTicketHelper
     * @param  \Modules\BookingProduct\Helpers\TableSlot                      $tableSlotHelper
     * @return void
     */
    public function __construct(
        BookingProductRepository $bookingProductRepository,
        DefaultSlotHelper $defaultSlotHelper,
        AppointmentSlotHelper $appointmentSlotHelper,
        RentalSlotHelper $rentalSlotHelper,
        EventTicketHelper $eventTicketHelper,
        TableSlotHelper $tableSlotHelper
    )
    {
        $this->bookingProductRepository = $bookingProductRepository;
        
        $this->bookingHelpers['default'] = $defaultSlotHelper;

        $this->bookingHelpers['appointment'] = $appointmentSlotHelper;

        $this->bookingHelpers['rental'] = $rentalSlotHelper;

        $this->bookingHelpers['event'] = $eventTicketHelper;

        $this->bookingHelpers['table'] = $tableSlotHelper;
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookingProduct = $this->bookingProductRepository->find(request('id'));

        return response()->json([
            'data' => $this->bookingHelpers[$bookingProduct->type]->getSlotsByDate($bookingProduct, request()->get('date')),
        ]);
    }
}