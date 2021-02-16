<?php

namespace Modules\Product;

use Illuminate\Support\Facades\Storage;
use Modules\Product\Helpers\AbstractProduct;

class ProductVideo extends AbstractProduct
{
    /**
     * Retrieve collection of videos
     *
     * @param  \Modules\Product\Contracts\Product|\Modules\Product\Contracts\ProductFlat  $product
     * @return array
     */
    public function getVideos($product)
    {
        if (! $product) {
            return [];
        }

        $videos = [];

        foreach ($product->videos as $video) {
            if (! Storage::has($video->path)) {
                continue;
            }

            $videos[] = [
                'type' => $video->type,
                'video_url'    => Storage::url($video->path),
            ];
        }

        return $videos;
    }
}