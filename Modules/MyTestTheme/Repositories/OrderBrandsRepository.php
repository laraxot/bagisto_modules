<?php

namespace Modules\MyTestTheme\Repositories;

use Modules\Core\Eloquent\Repository;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * OrderBrands Repository
 *
 * @copyright 2019 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class OrderBrandsRepository extends Repository
{
    use CacheableRepository;

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return 'Modules\myTestTheme\Contracts\OrderBrand';
    }

}