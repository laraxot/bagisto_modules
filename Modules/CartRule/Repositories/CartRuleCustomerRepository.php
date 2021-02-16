<?php

namespace Modules\CartRule\Repositories;

use Modules\Core\Eloquent\Repository;

class CartRuleCustomerRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Modules\CartRule\Contracts\CartRuleCustomer';
    }
}