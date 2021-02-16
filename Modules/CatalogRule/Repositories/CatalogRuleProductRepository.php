<?php

namespace Modules\CatalogRule\Repositories;

use Modules\Core\Eloquent\Repository;

class CatalogRuleProductRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Modules\CatalogRule\Contracts\CatalogRuleProduct';
    }
}