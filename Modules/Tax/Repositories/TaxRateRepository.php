<?php

namespace Modules\Tax\Repositories;

use Modules\Core\Eloquent\Repository;

class TaxRateRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Modules\Tax\Contracts\TaxRate';
    }
}