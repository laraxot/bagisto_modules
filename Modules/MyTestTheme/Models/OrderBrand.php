<?php

namespace Modules\MyTestTheme\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\MyTestTheme\Contracts\OrderBrand as OrderBrandContract;
use Modules\Attribute\Models\AttributeOptionProxy;
use Modules\Category\Models\CategoryProxy;

class OrderBrand extends Model implements OrderBrandContract
{
    
    protected $table = 'order_brands';

    protected $fillable = [
        'order_item_id',
        'order_id',
        'product_id',
        'brand',
    ];

    public function getBrands()
    {
        return $this->belongsTo(AttributeOptionProxy::modelClass() , 'brand');
    }

    /**
     * The categories that belong to the product.
     */
    public function categories()
    {
        return $this->belongsToMany(CategoryProxy::modelClass(), 'product_categories','product_id');
    }
    
}