<?php

namespace Modules\Checkout\Repositories;

use Modules\Core\Eloquent\Repository;
use Modules\Checkout\Contracts\CartItem;

class CartItemRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */

    function model()
    {
        return 'Modules\Checkout\Contracts\CartItem';
    }

    /**
     * @param array  $data
     * @param        $id
     * @param string $attribute
     *
     * @return \Modules\Checkout\Contracts\CartItem|null
     */
    public function update(array $data, $id, $attribute = "id"): ?CartItem
    {
        $item = $this->find($id);

        if ($item) {
            $item->update($data);
        }

        return $item;
    }

    /**
     * @param  int  $cartItemId
     * @return int
     */
    public function getProduct($cartItemId)
    {
        return $this->model->find($cartItemId)->product->id;
    }
}