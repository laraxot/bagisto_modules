<?php

namespace Modules\CatalogRule\Helpers;

use Carbon\Carbon;
use Modules\CatalogRule\Repositories\CatalogRuleRepository;

class CatalogRuleIndex
{
    /**
     * CatalogRuleRepository object
     *
     * @var \Modules\CatalogRule\Repositories\CatalogRuleRepository
    */
    protected $catalogRuleRepository;

    /**
     * CatalogRuleProduct object
     *
     * @var \Modules\CatalogRule\Helpers\CatalogRuleProduct
    */
    protected $catalogRuleHelper;

    /**
     * CatalogRuleProductPrice object
     *
     * @var \Modules\CatalogRule\Helpers\CatalogRuleProductPrice
    */
    protected $catalogRuleProductPriceHelper;

    /**
     * Create a new helper instance.
     *
     * @param  \Modules\CatalogRule\Repositories\CatalogRuleRepository  $catalogRuleRepository
     * @param  \Modules\CatalogRuleProduct\Helpers\CatalogRuleProduct  $catalogRuleProductHelper
     * @param  \Modules\CatalogRuleProduct\Helpers\CatalogRuleProductPrice  $catalogRuleProductPriceHelper
     * @return void
     */
    public function __construct(
        CatalogRuleRepository $catalogRuleRepository,
        CatalogRuleProduct $catalogRuleProductHelper,
        CatalogRuleProductPrice $catalogRuleProductPriceHelper
    )
    {
        $this->catalogRuleRepository = $catalogRuleRepository;

        $this->catalogRuleProductHelper = $catalogRuleProductHelper;

        $this->catalogRuleProductPriceHelper = $catalogRuleProductPriceHelper;
    }

    /**
     * Full reindex
     *
     * @return void
     */
    public function reindexComplete()
    {
        try {
            $this->cleanIndexes();

            foreach ($this->getCatalogRules() as $rule) {
                $this->catalogRuleProductHelper->insertRuleProduct($rule);
            }

            $this->catalogRuleProductPriceHelper->indexRuleProductPrice(1000);
        } catch (\Exception $e) {
            report($e);
        }
    }

    /**
     * Full reindex
     *
     * @param  \Modules\Product\Contracts\Product  $product
     * @return void
     */
    public function reindexProduct($product)
    {
        try {
            if (! $product->getTypeInstance()->priceRuleCanBeApplied()) {
                return;
            }

            $productIds = $product->getTypeInstance()->isComposite()
                          ? $product->getTypeInstance()->getChildrenIds()
                          : [$product->id];

            $this->cleanIndexes($productIds);

            foreach ($this->getCatalogRules() as $rule) {
                $this->catalogRuleProductHelper->insertRuleProduct($rule, 1000, $product);
            }

            $this->catalogRuleProductPriceHelper->indexRuleProductPrice(1000, $product);
        } catch (\Exception $e) {
            report($e);
        }
    }

    /**
     * Deletes catalog rule product and catalog rule product price indexes
     *
     * @param  array  $productIds
     * @return void
     */
    public function cleanIndexes($productIds = [])
    {
        $this->catalogRuleProductHelper->cleanProductIndex($productIds);

        $this->catalogRuleProductPriceHelper->cleanProductPriceIndex($productIds);
    }

    /**
     * Returns catalog rules
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCatalogRules()
    {
        static $catalogRules;

        if ($catalogRules) {
            return $catalogRules;
        }

        $catalogRules = $this->catalogRuleRepository->scopeQuery(function($query) {
            return $query->where(function ($query1) {
                        $query1->where('catalog_rules.starts_from', '<=', Carbon::now()->format('Y-m-d'))
                               ->orWhereNull('catalog_rules.starts_from');
                    })
                    ->where(function ($query2) {
                        $query2->where('catalog_rules.ends_till', '>=', Carbon::now()->format('Y-m-d'))
                               ->orWhereNull('catalog_rules.ends_till');
                    })
                    ->orderBy('sort_order', 'asc');
        })->findWhere(['status' => 1]);

        return $catalogRules;
    }
}