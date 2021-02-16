<?php

namespace Modules\Velocity\Repositories;

use Modules\Core\Eloquent\Repository;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Review Repository
 *
 * @copyright 2019 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class ReviewRepository extends Repository
{
    use CacheableRepository;

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return 'Modules\Product\Contracts\ProductReview';
    }


    function getAll()
    {
        $reviews = $this->model->get();

        return $reviews;
    }
}