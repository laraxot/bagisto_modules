<?php

namespace Modules\MyTestTheme\Http\Controllers\Shop;

use Cart;
use Illuminate\Support\Facades\Log;
use Modules\MyTestTheme\Helpers\Helper;
use Modules\Checkout\Contracts\Cart as CartModel;
use Modules\Product\Repositories\ProductRepository;

class CartController extends Controller
{
    /**
     * Retrives the mini cart details
     *
     * @return \Illuminate\Http\Response
    */
    public function getMiniCartDetails()
    {
        $cart = cart()->getCart();

        if ($cart) {
            $items = $cart->items;
            $cartItems = $items->toArray();

            $cartDetails = [];
            $cartDetails['base_sub_total'] = core()->currency($cart->base_sub_total);

            /* needed raw data for comparison */
            $cartDetails['raw']['base_sub_total'] = $cart->base_sub_total;

            foreach ($items as $index => $item) {
                $images = $item->product->getTypeInstance()->getBaseImage($item);

                $cartItems[$index]['images'] = $images;
                $cartItems[$index]['url_key'] = $item->product->url_key;
                $cartItems[$index]['base_total'] = core()->currency($item->base_total);
            }

            $response = [
                'status'    => true,
                'mini_cart' => [
                    'cart_items' => $cartItems,
                    'cart_details' => $cartDetails,
                ],
            ];
        } else {
            $response = [
                'status' => false,
            ];
        }

        return response()->json($response, 200);
    }

    /**
     * Function for guests user to add the product in the cart.
     *
     * @return array
    */
    public function addProductToCart()
    {
        try {
            $cart = Cart::getCart();
            $id = request()->get('product_id');

            $cart = Cart::addProduct($id, request()->all());

            if (is_array($cart) && isset($cart['warning'])) {
                $response = [
                    'status'  => 'warning',
                    'message' => $cart['warning'],
                ];
            }

            if ($cart instanceof CartModel) {
                $formattedItems = [];

                foreach ($cart->items as $item) {
                    array_push($formattedItems, $this->myTestThemeHelper->formatCartItem($item));
                }

                $response = [
                    'status'         => 'success',
                    'totalCartItems' => sizeof($cart->items),
                    'message'        => trans('shop::app.checkout.cart.item.success'),
                ];

                if ($customer = auth()->guard('customer')->user()) {
                    app('Modules\Customer\Repositories\WishlistRepository')->deleteWhere(['product_id' => $id, 'customer_id' => $customer->id]);
                }

                if (request()->get('is_buy_now')) {
                    return redirect()->route('shop.checkout.onepage.index');
                }
            }
        } catch(\Exception $exception) {

            session()->flash('warning', __($exception->getMessage()));

            $product = $this->productRepository->find($id);

            Log::error('myTestTheme CartController: ' . $exception->getMessage(),
                ['product_id' => $id, 'cart_id' => cart()->getCart() ?? 0]);

            $response = [
                'status'           => 'danger',
                'message'          => __($exception->getMessage()),
                'redirectionRoute' => route('shop.productOrCategory.index', $product->url_key),
            ];
        }

        return $response ?? [
            'status'  => 'danger',
            'message' => __('myTestTheme::app.error.something_went_wrong'),
        ];
    }

    /**
     * Removes the item from the cart if it exists
     *
     * @param  int  $itemId
     * @return \Illuminate\Http\Response
    */
    public function removeProductFromCart($itemId)
    {
        $result = Cart::removeItem($itemId);

        if ($result) {
            $response = [
                'status'  => 'success',
                'label'   => trans('myTestTheme::app.shop.general.alert.success'),
                'message' => trans('shop::app.checkout.cart.item.success-remove'),
            ];
        }

        return response()->json($response ?? [
            'status'  => 'danger',
            'label'   => trans('myTestTheme::app.shop.general.alert.error'),
            'message' => trans('myTestTheme::app.error.something_went_wrong'),
        ], 200);
    }
}