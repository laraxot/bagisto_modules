<?php

namespace Modules\CatalogRule\Listeners;

use Modules\CatalogRule\Helpers\CatalogRuleIndex;

class Product
{
    /**
     * Product Repository Object
     * 
     * @var \Modules\CatalogRule\Helpers\CatalogRuleIndex
     */
    protected $catalogRuleIndexHelper;

    /**
     * Create a new listener instance.
     * 
     * @param  \Modules\CatalogRule\Helpers\CatalogRuleIndex  $catalogRuleIndexHelper
     * @return void
     */
    public function __construct(CatalogRuleIndex $catalogRuleIndexHelper)
    {
        $this->catalogRuleIndexHelper = $catalogRuleIndexHelper;
    }

    /**
     * @param  \Modules\Product\Contracts\Product  $product
     * @return void
     */
    public function createProductRuleIndex($product)
    {
        $this->catalogRuleIndexHelper->reindexProduct($product);
    }
}