<?php

namespace Modules\Product\Providers;

use Modules\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Modules\Product\Models\Product::class,
        \Modules\Product\Models\ProductAttributeValue::class,
        \Modules\Product\Models\ProductFlat::class,
        \Modules\Product\Models\ProductImage::class,
        \Modules\Product\Models\ProductInventory::class,
        \Modules\Product\Models\ProductOrderedInventory::class,
        \Modules\Product\Models\ProductReview::class,
        \Modules\Product\Models\ProductSalableInventory::class,
        \Modules\Product\Models\ProductDownloadableSample::class,
        \Modules\Product\Models\ProductDownloadableLink::class,
        \Modules\Product\Models\ProductGroupedProduct::class,
        \Modules\Product\Models\ProductBundleOption::class,
        \Modules\Product\Models\ProductBundleOptionTranslation::class,
        \Modules\Product\Models\ProductBundleOptionProduct::class,
        \Modules\Product\Models\ProductCustomerGroupPrice::class,
        \Modules\Product\Models\ProductVideo::class,
    ];
}