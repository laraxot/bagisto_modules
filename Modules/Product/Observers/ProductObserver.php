<?php

namespace Modules\Product\Observers;

use Illuminate\Support\Facades\Storage;

class ProductObserver
{
    /**
     * Handle the Product "deleted" event.
     *
     * @param  \Modules\Product\Contracts\Product  $product
     * @return void
     */
    public function deleted($product)
    {
        Storage::deleteDirectory('product/' . $product->id);
    }
}