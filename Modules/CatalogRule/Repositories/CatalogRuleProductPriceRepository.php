<?php

namespace Modules\CatalogRule\Repositories;

use Illuminate\Support\Carbon;
use Modules\Core\Eloquent\Repository;

class CatalogRuleProductPriceRepository extends Repository
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    function model()
    {
        return 'Modules\CatalogRule\Contracts\CatalogRuleProductPrice';
    }

    /**
     * Check if catalog rule prices already loaded. If already loaded then load from it.
     *
     * @return object
     */
    public function checkInLoadedCatalogRulePrice($product, $customerGroupId)
    {
        static $catalogRulePrices = [];

        if (array_key_exists($product->id, $catalogRulePrices)) {
            return $catalogRulePrices[$product->id];
        }

        return $catalogRulePrices[$product->id] = $this->findOneWhere([
            'product_id'        => $product->id,
            'channel_id'        => core()->getCurrentChannel()->id,
            'customer_group_id' => $customerGroupId,
            'rule_date'         => Carbon::now()->format('Y-m-d'),
        ]);
    }
}