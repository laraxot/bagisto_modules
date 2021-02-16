<?php

namespace Modules\Product\Repositories;

use Illuminate\Container\Container as App;
use Modules\Core\Eloquent\Repository;

class ProductReviewRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Modules\Product\Contracts\ProductReview';
    }

    /**
     * Retrieve review for customerId
     *
     * @param int $customerId
     */
    function getCustomerReview()
    {
        $customerId = auth()->guard('customer')->user()->id;

        $reviews = $this->model->where(['customer_id'=> $customerId])->with('product')->paginate(5);

        return $reviews;
    }
}