<?php

namespace Modules\Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Product\Models\ProductProxy;
use Modules\Customer\Contracts\Wishlist as WishlistContract;

class Wishlist extends Model implements WishlistContract
{
    protected $table = 'wishlist';

    protected $casts = [
        'additional' => 'array',
    ];

    protected $fillable = [
        'channel_id',
        'product_id',
        'customer_id',
        'additional',
        'moved_to_cart',
        'shared',
        'time_of_moving'
    ];

    /**
     * The Product that belong to the wishlist.
     */
    public function product()
    {
        return $this->hasOne(ProductProxy::modelClass(), 'id', 'product_id');
    }
}
