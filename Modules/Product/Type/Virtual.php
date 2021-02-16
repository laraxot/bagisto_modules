<?php

namespace Modules\Product\Type;

class Virtual extends AbstractType
{
    /**
     * Skip attribute for virtual product type
     *
     * @var array
     */
    protected $skipAttributes = ['width', 'height', 'depth', 'weight'];

    /**
     * These blade files will be included in product edit page
     *
     * @var array
     */
    protected $additionalViews = [
        'admin::catalog.products.accordians.inventories',
        'admin::catalog.products.accordians.images',
        'admin::catalog.products.accordians.categories',
        'admin::catalog.products.accordians.channels',
        'admin::catalog.products.accordians.product-links',
        'admin::catalog.products.accordians.videos',
    ];

    /**
     * Is a stokable product type
     *
     * @var bool
     */
    protected $isStockable = false;

    /**
     * Show quantity box
     *
     * @var bool
     */
    protected $showQuantityBox = true;

    /**
     * Return true if this product type is saleable
     *
     * @return bool
     */
    public function isSaleable()
    {
        if (! $this->product->status) {
            return false;
        }

        if (is_callable(config('products.isSaleable')) &&
            call_user_func(config('products.isSaleable'), $this->product) === false) {
            return false;
        }

        if ($this->haveSufficientQuantity(1)) {
            return true;
        }

        return false;
    }

    /**
     * @param int $qty
     *
     * @return bool
     */
    public function haveSufficientQuantity(int $qty): bool
    {
        return $qty <= $this->totalQuantity() ? true : false;
    }
}