<?php

namespace Modules\Checkout\Repositories;

use Modules\Core\Eloquent\Repository;

/**
 * Cart Address Repository
 *
 * @author    Prashant Singh <prashant.singh852@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class CartAddressRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return 'Modules\Checkout\Contracts\CartAddress';
    }
}