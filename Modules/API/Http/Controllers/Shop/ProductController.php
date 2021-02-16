<?php

namespace Modules\API\Http\Controllers\Shop;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Product\Repositories\ProductRepository;
use Modules\API\Http\Resources\Catalog\Product as ProductResource;

class ProductController extends Controller
{
    /**
     * ProductRepository object
     *
     * @var \Modules\Product\Repositories\ProductRepository
     */
    protected $productRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Modules\Product\Repositories\ProductRepository $productRepository
     * @return void
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Returns a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductResource::collection($this->productRepository->getAll(request()->input('category_id')));
    }

    /**
     * Returns a individual resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        return new ProductResource(
            $this->productRepository->findOrFail($id)
        );
    }

    /**
     * Returns product's additional information.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function additionalInformation($id)
    {
        return response()->json([
            'data' => app('Modules\Product\Helpers\View')->getAdditionalData($this->productRepository->findOrFail($id)),
        ]);
    }

    /**
     * Returns product's additional information.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function configurableConfig($id)
    {
        return response()->json([
            'data' => app('Modules\Product\Helpers\ConfigurableOption')->getConfigurationConfig($this->productRepository->findOrFail($id)),
        ]);
    }
}
