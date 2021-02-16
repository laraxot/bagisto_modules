<?php

namespace Modules\Core\Repositories;

use Modules\Core\Eloquent\Repository;
use Prettus\Repository\Traits\CacheableRepository;

class CountryStateRepository extends Repository
{
    use CacheableRepository;

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Modules\Core\Contracts\CountryState';
    }
}