<?php

namespace Modules\Velocity\Http\Controllers\Shop;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Modules\Velocity\Helpers\Helper;
use Modules\Product\Repositories\SearchRepository;
use Modules\Product\Repositories\ProductRepository;
use Modules\Customer\Repositories\WishlistRepository;
use Modules\Category\Repositories\CategoryRepository;
use Modules\Velocity\Repositories\Product\ProductRepository as VelocityProductRepository;
use Modules\Velocity\Repositories\VelocityCustomerCompareProductRepository as CustomerCompareProductRepository;

class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * SearchRepository object
     *
     * @var \Modules\Product\Repositories\SearchRepository
     */
    protected $searchRepository;

    /**
     * ProductRepository object
     *
     * @var \Modules\Product\Repositories\ProductRepository
     */
    protected $productRepository;

    /**
     * ProductRepository object of velocity package
     *
     * @var \Modules\Velocity\Repositories\Product\ProductRepository
     */
    protected $velocityProductRepository;

    /**
     * CategoryRepository object of velocity package
     *
     * @var \Modules\Category\Repositories\CategoryRepository
     */
    protected $categoryRepository;

    /**
     * WishlistRepository object
     *
     * @var \Modules\Customer\Repositories\WishlistRepository
     */
    protected $wishlistRepository;

    /**
     * Helper object
     *
     * @var \Modules\Velocity\Helpers\Helper
     */
    protected $velocityHelper;

    /**
     * VelocityCustomerCompareProductRepository object of repository
     *
     * @var \Modules\Velocity\Repositories\VelocityCustomerCompareProductRepository
     */
    protected $compareProductsRepository;


    /**
     * Create a new controller instance.
     *
     * @param  \Modules\Velocity\Helpers\Helper                                         $velocityHelper
     * @param  \Modules\Product\Repositories\SearchRepository                           $searchRepository
     * @param  \Modules\Product\Repositories\ProductRepository                          $productRepository
     * @param  \Modules\Category\Repositories\CategoryRepository                        $categoryRepository
     * @param  \Modules\Velocity\Repositories\Product\ProductRepository                 $velocityProductRepository
     * @param  \Modules\Velocity\Repositories\VelocityCustomerCompareProductRepository  $compareProductsRepository
     *
     * @return void
     */
    public function __construct(
        Helper $velocityHelper,
        SearchRepository $searchRepository,
        ProductRepository $productRepository,
        WishlistRepository $wishlistRepository,
        CategoryRepository $categoryRepository,
        VelocityProductRepository $velocityProductRepository,
        CustomerCompareProductRepository $compareProductsRepository
    ) {
        $this->_config = request('_config');

        $this->velocityHelper = $velocityHelper;

        $this->searchRepository = $searchRepository;

        $this->productRepository = $productRepository;

        $this->categoryRepository = $categoryRepository;

        $this->wishlistRepository = $wishlistRepository;

        $this->velocityProductRepository = $velocityProductRepository;

        $this->compareProductsRepository = $compareProductsRepository;
    }
}
