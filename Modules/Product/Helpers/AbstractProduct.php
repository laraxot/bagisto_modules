<?php

namespace Modules\Product\Helpers;

use Modules\Product\Models\ProductAttributeValue;
use Modules\Product\Models\ProductFlatProxy;
use Modules\Product\Models\ProductFlat;

abstract class AbstractProduct
{
    /**
     * array
     *
     * @var array
     */
    protected $productFlat = [];

    /**
     * Add Channle and Locale filter
     *
     * @param  \Modules\Attribute\Contracts\Attribute  $attribute
     * @param  \Illuminate\Database\Eloquent\Builder  $qb
     * @param  string  $alias
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function applyChannelLocaleFilter($attribute, $qb, $alias = 'product_attribute_values')
    {
        $channel = request()->get('channel') ?: (core()->getCurrentChannelCode() ?: core()->getDefaultChannelCode());

        $locale = request()->get('locale') ?: app()->getLocale();

        if ($attribute->value_per_channel) {
            if ($attribute->value_per_locale) {
                $qb->where($alias . '.channel', $channel)
                    ->where($alias . '.locale', $locale);
            } else {
                $qb->where($alias . '.channel', $channel);
            }
        } else {
            if ($attribute->value_per_locale) {
                $qb->where($alias . '.locale', $locale);
            }
        }

        return $qb;
    }

    /**
     * Sets product flat variable
     *
     * @param  \Modules\Product\Contracts\Product|\Modules\Product\Contracts\ProductFlat  $product
     * @return void|null
     */
    public function setProductFlat($product)
    {
        if (array_key_exists($product->id, $this->productFlat)) {
            return;
        }

        if (! $product instanceof ProductFlat) {
            $this->productFlat[$product->id] = ProductFlatProxy::modelClass()
                ::where('product_flat.product_id', $product->id)
                ->where('product_flat.locale', app()->getLocale())
                ->where('product_flat.channel', core()->getCurrentChannelCode())
                ->select('product_flat.*')
                ->first();
        } else {
            $this->productFlat[$product->id] = $product;
        }
    }
}