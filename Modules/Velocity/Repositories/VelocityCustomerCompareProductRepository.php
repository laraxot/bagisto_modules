<?php

namespace Modules\Velocity\Repositories;

use Modules\Core\Eloquent\Repository;

class VelocityCustomerCompareProductRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return 'Modules\Velocity\Contracts\VelocityCustomerCompareProduct';
    }
}