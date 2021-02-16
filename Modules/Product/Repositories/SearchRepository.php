<?php

namespace Modules\Product\Repositories;

use Illuminate\Container\Container as App;
use Illuminate\Support\Facades\Storage;
use Modules\Core\Eloquent\Repository;
use Modules\Product\Repositories\ProductRepository;

class SearchRepository extends Repository
{
    /**
     * ProductRepository object
     *
     * @return Object
     */
    protected $productRepository;

    /**
     * Create a new repository instance.
     *
     * @param \Modules\Product\Repositories\ProductRepository $productRepository
     * @param \Illuminate\Container\Container                $app
     *
     * @return void
     */
    public function __construct(
        ProductRepository $productRepository,
        App $app
    ) {
        parent::__construct($app);

        $this->productRepository = $productRepository;
    }

    function model()
    {
        return 'Modules\Product\Contracts\Product';
    }

    public function search($data)
    {
        return $this->productRepository->searchProductByAttribute($data['term'] ?? '');
    }

    /**
     * @param  array  $data
     * @return void
     */
    public function uploadSearchImage($data)
    {
        $path = request()->file('image')->store('product-search');

        return Storage::url($path);
    }
}