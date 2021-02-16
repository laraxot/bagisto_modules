<?php

namespace Modules\BookingProduct\Repositories;

use Modules\Core\Eloquent\Repository;

class BookingProductTableSlotRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Modules\BookingProduct\Contracts\BookingProductTableSlot';
    }
}