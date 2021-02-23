<?php

namespace Modules\MyTestTheme\Http\Controllers\Shop;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Modules\MyTestTheme\Helpers\Helper;
use Modules\Product\Repositories\SearchRepository;
use Modules\Product\Repositories\ProductRepository;
use Modules\Customer\Repositories\WishlistRepository;
use Modules\Category\Repositories\CategoryRepository;
use Modules\MyTestTheme\Repositories\Product\ProductRepository as myTestThemeProductRepository;
use Modules\MyTestTheme\Repositories\myTestThemeCustomerCompareProductRepository as CustomerCompareProductRepository;

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
     * ProductRepository object of myTestTheme package
     *
     * @var \Modules\myTestTheme\Repositories\Product\ProductRepository
     */
    protected $myTestThemeProductRepository;

    /**
     * CategoryRepository object of myTestTheme package
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
     * @var \Modules\myTestTheme\Helpers\Helper
     */
    protected $myTestThemeHelper;

    /**
     * myTestThemeCustomerCompareProductRepository object of repository
     *
     * @var \Modules\myTestTheme\Repositories\myTestThemeCustomerCompareProductRepository
     */
    protected $compareProductsRepository;


    /**
     * Create a new controller instance.
     *
     * @param  \Modules\myTestTheme\Helpers\Helper                                         $myTestThemeHelper
     * @param  \Modules\Product\Repositories\SearchRepository                           $searchRepository
     * @param  \Modules\Product\Repositories\ProductRepository                          $productRepository
     * @param  \Modules\Category\Repositories\CategoryRepository                        $categoryRepository
     * @param  \Modules\myTestTheme\Repositories\Product\ProductRepository                 $myTestThemeProductRepository
     * @param  \Modules\myTestTheme\Repositories\myTestThemeCustomerCompareProductRepository  $compareProductsRepository
     *
     * @return void
     */
    public function __construct(
        Helper $myTestThemeHelper,
        SearchRepository $searchRepository,
        ProductRepository $productRepository,
        WishlistRepository $wishlistRepository,
        CategoryRepository $categoryRepository,
        myTestThemeProductRepository $myTestThemeProductRepository,
        CustomerCompareProductRepository $compareProductsRepository
    ) {
        $this->_config = request('_config');

        $this->myTestThemeHelper = $myTestThemeHelper;

        $this->searchRepository = $searchRepository;

        $this->productRepository = $productRepository;

        $this->categoryRepository = $categoryRepository;

        $this->wishlistRepository = $wishlistRepository;

        $this->myTestThemeProductRepository = $myTestThemeProductRepository;

        $this->compareProductsRepository = $compareProductsRepository;
    }
}
