<?php

namespace Modules\MyTestTheme\Helpers;

use Illuminate\Support\Facades\DB;
use Modules\Product\Helpers\Review;
use Modules\Product\Facades\ProductImage;
use Modules\Product\Models\Product as ProductModel;
use Modules\Product\Repositories\ProductRepository;
use Modules\Product\Repositories\ProductFlatRepository;
use Modules\myTestTheme\Repositories\OrderBrandsRepository;
use Modules\Product\Repositories\ProductReviewRepository;
use Modules\Attribute\Repositories\AttributeOptionRepository;
use Modules\myTestTheme\Repositories\myTestThemeMetadataRepository;

class Helper extends Review
{
    /**
     * productModel object
     *
     * @var \Modules\Product\Contracts\Product
     */
   protected $productModel;

    /**
     * orderBrands object
     *
     * @var \Modules\myTestTheme\Repositories\OrderBrandsRepository
     */
    protected $orderBrandsRepository;

    /**
     * ProductRepository object
     *
     * @var \Modules\Product\Repositories\ProductRepository
     */
    protected $productRepository;

    /**
     * ProductFlatRepository object
     *
     * @var \Modules\Product\Repositories\ProductFlatRepository
     */
    protected $productFlatRepository;

    /**
     * productModel object
     *
     * @var \Modules\Attribute\Repositories\AttributeOptionRepository
     */
    protected $attributeOptionRepository;

    /**
     * ProductReviewRepository object
     *
     * @var \Modules\Product\Repositories\ProductReviewRepository
     */
    protected $productReviewRepository;

    /**
     * myTestThemeMetadata object
     *
     * @var \Modules\myTestTheme\Repositories\myTestThemeMetadataRepository
     */
    protected $myTestThemeMetadataRepository;

    /**
     * Create a helper instamce
     *
     * @param  \Modules\Product\Contracts\Product                        $productModel
     * @param  \Modules\myTestTheme\Repositories\OrderBrandsRepository      $orderBrands
     * @param  \Modules\Attribute\Repositories\AttributeOptionRepository $attributeOptionRepository
     * @param  \Modules\Product\Repositories\ProductReviewRepository     $productReviewRepository
     * @param  \Modules\myTestTheme\Repositories\myTestThemeMetadataRepository $myTestThemeMetadataRepository
     *
     * @return void
     */
    public function __construct(
        ProductModel $productModel,
        ProductRepository $productRepository,
        AttributeOptionRepository $attributeOptionRepository,
        ProductFlatRepository $productFlatRepository,
        OrderBrandsRepository $orderBrandsRepository,
        ProductReviewRepository $productReviewRepository,
        myTestThemeMetadataRepository $myTestThemeMetadataRepository
    ) {
        $this->productModel =  $productModel;

        $this->attributeOptionRepository =  $attributeOptionRepository;

        $this->productRepository = $productRepository;

        $this->productFlatRepository = $productFlatRepository;

        $this->orderBrandsRepository = $orderBrandsRepository;

        $this->productReviewRepository =  $productReviewRepository;

        $this->myTestThemeMetadataRepository =  $myTestThemeMetadataRepository;
    }

    /**
     * @param  \Modules\Sales\Contracts\Order $order
     *
     * @return void
     */
    public function topBrand($order)
    {
        $orderItems = $order->items;

        foreach ($orderItems as $key => $orderItem) {
            $products[] = $orderItem->product;

            try {
                $this->orderBrandsRepository->create([
                    'order_item_id' => $orderItem->id,
                    'order_id'      => $orderItem->order_id,
                    'product_id'    => $orderItem->product_id,
                    'brand'         => $products[$key]->brand,
                ]);
            } catch(\Exception $exception) {}
        }
    }

    /**
     * @return \Illuminate\Support\Collection|\Exception
     */
    public function getBrandsWithCategories()
    {
        try {
            $orderBrand = $this->orderBrandsRepository->get()->toArray();

            if (isset($orderBrand) && ! empty($orderBrand)) {
                foreach ($orderBrand as $product) {
                    $product_id[] = $product['product_id'];

                    $product_categories = $this->productRepository->with('categories')->findWhereIn('id', $product_id)->toArray();
                }

                $categoryName = $brandName = $brandImplode = [];

                foreach($product_categories as $totalData) {
                    $brand = $this->attributeOptionRepository->findOneWhere(['id' => $totalData['brand']]);

                    foreach ($totalData['categories'] as $categories) {
                        foreach($categories['translations'] as $catName) {
                            if (isset($brand->admin_name)) {
                                $brandData[$brand->admin_name][] = $catName['name'];
                                $categoryName[] = $catName['name'];
                            }
                        }
                    }
                }

                $uniqueCategoryName = array_unique($categoryName);

                foreach($uniqueCategoryName as $key => $categoryNameValue) {
                    foreach($brandData as $brandDataKey => $brandDataValue) {
                        if(in_array($categoryNameValue,$brandDataValue)) {
                            $brandName[$categoryNameValue][] = $brandDataKey;
                        }
                    }
                }

                foreach($brandName as $brandKey => $brandvalue) {
                    $brandImplode[$brandKey][] = implode(' | ',array_map("ucfirst", $brandvalue));
                }

                return $brandImplode;
            }
        } catch (Exception $exception){
            throw $exception;
        }
    }

    /**
     * Returns the count rating of the product.
     *
     * @return array
     */
    public function getmyTestThemeMetaData($locale = null, $channel = null, $default = true)
    {
        static $metaData;

        if ($metaData) {
            return $metaData;
        }

        if (! $locale) {
            $locale = request()->get('locale') ?: app()->getLocale();
        }

        if (! $channel) {
            $channel = request()->get('channel') ?: core()->getCurrentChannelCode() ?: 'default';
        }

        try {
            $metaData = $this->myTestThemeMetadataRepository->findOneWhere([
                'locale' => $locale,
                'channel' => $channel
            ]);

            if (! $metaData && $default) {
                $metaData = $this->myTestThemeMetadataRepository->findOneWhere([
                    'locale' => 'en',
                    'channel' => 'default'
                ]);
            }

            return $metaData;
        } catch (\Exception $exception) {
        }
    }

    /**
     * @param  int  $reviewCount
     * @return \Illuminate\Support\Collection
     */
    public function getShopRecentReviews($reviewCount = 4)
    {
        $reviews = $this->productReviewRepository
                        ->getModel()
                        ->orderBy('id', 'desc')
                        ->where('status', 'approved')
                        ->take($reviewCount)->get();

        return $reviews;
    }

    /**
     * @return array
     */
    public function jsonTranslations()
    {
        $currentLocale = app()->getLocale();

        $path = __DIR__ . "/../Resources/lang/$currentLocale/app.php";

        if (is_string($path) && is_readable($path)) {
            return include $path;
        } else {
            $currentLocale = "en";

            $path = __DIR__ . "/../Resources/lang/$currentLocale/app.php";

            return include $path;
        }
    }

    /**
     * @param  \Modules\Checkout\Contracts\CartItem  $item
     * @return array
     */
    public function formatCartItem($item)
    {
        $product = $item->product;

        $images = $product->getTypeInstance()->getBaseImage($item);

        return [
            'images'    => $images,
            'itemId'    => $item->id,
            'name'      => $item->name,
            'quantity'  => $item->quantity,
            'url_key'   => $product->url_key,
            'baseTotal' => core()->currency($item->base_total),
        ];
    }

    /**
     * @param  \Modules\Product\Contracts\Product  $product
     * @param  bool                               $list
     * @param  array                              $metaInformation
     *
     * @return array
     */
    public function formatProduct($product, $list = false, $metaInformation = [])
    {
        $reviewHelper = app('Modules\Product\Helpers\Review');

        $galleryImages = ProductImage::getGalleryImages($product);
        $productImage = ProductImage::getProductBaseImage($product, $galleryImages)['medium_image_url'];

        $largeProductImageName = "large-product-placeholder.png";
        $mediumProductImageName = "meduim-product-placeholder.png";

        if (strpos($productImage, $mediumProductImageName) > -1) {
            $productImageNameCollection = explode('/', $productImage);
            $productImageName = $productImageNameCollection[sizeof($productImageNameCollection) - 1];

            if ($productImageName == $mediumProductImageName) {
                $productImage = str_replace($mediumProductImageName, $largeProductImageName, $productImage);
            }
        }

        $priceHTML = view('shop::products.price', ['product' => $product])->render();

        $isProductNew = ($product->new && ! strpos($priceHTML, 'sticker sale') > 0) ? __('shop::app.products.new') : false;

        return [
            'priceHTML'         => $priceHTML,
            'avgRating'         => ceil($reviewHelper->getAverageRating($product)),
            'totalReviews'      => $reviewHelper->getTotalReviews($product),
            'image'             => $productImage,
            'new'               => $isProductNew,
            'galleryImages'     => $galleryImages,
            'name'              => $product->name,
            'slug'              => $product->url_key,
            'description'       => $product->description,
            'shortDescription'  => $product->short_description,
            'firstReviewText'   => trans('myTestTheme::app.products.be-first-review'),
            'addToCartHtml'     => view('shop::products.add-to-cart', [
                'product'           => $product,
                'addWishlistClass'  => ! (isset($list) && $list) ? '' : '',

                'showCompare'       => core()->getConfigData('general.content.shop.compare_option') == "1"
                                       ? true : false,

                'btnText'           => (isset($metaInformation['btnText']) && $metaInformation['btnText'])
                                       ? $metaInformation['btnText'] : null,

                'moveToCart'        => (isset($metaInformation['moveToCart']) && $metaInformation['moveToCart'])
                                       ? $metaInformation['moveToCart'] : null,

                'addToCartBtnClass' => ! (isset($list) && $list) ? 'small-padding' : '',
            ])->render(),
        ];
    }

    /**
     * Returns the count rating of the product
     *
     * @param $items
     * @param $separator
     *
     * @return array
     */
    public function fetchProductCollection($items, $moveToCart = false, $separator='&')
    {
        $productIds = collect(explode($separator, $items));

        return $productIds->map(function ($productId) use ($moveToCart) {
            $productFlat = $this->productFlatRepository->findOneWhere(['id' => $productId]);

            if ($productFlat) {
                $formattedProduct = $this->formatProduct($productFlat, false, [
                    'moveToCart' => $moveToCart,
                    'btnText' => $moveToCart ? trans('shop::app.customer.account.wishlist.move-to-cart') : null,
                ]);

                return array_merge($productFlat->toArray(), [
                    'slug' => $productFlat->url_key,
                    'product_image' => $formattedProduct['image'],
                    'priceHTML' => $formattedProduct['priceHTML'],
                    'new' => $formattedProduct['new'],
                    'addToCartHtml' => $formattedProduct['addToCartHtml'],
                    'galleryImages' => $formattedProduct['galleryImages']
                ]);
            }
        })->toArray();
    }
}
