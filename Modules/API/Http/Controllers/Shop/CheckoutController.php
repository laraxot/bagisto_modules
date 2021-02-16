<?php

namespace Modules\API\Http\Controllers\Shop;

use Cart;
use Exception;
use Illuminate\Support\Str;
use Modules\Payment\Facades\Payment;
use Modules\Shipping\Facades\Shipping;
use Modules\Sales\Repositories\OrderRepository;
use Modules\Checkout\Repositories\CartRepository;
use Modules\Shop\Http\Controllers\OnepageController;
use Modules\Checkout\Repositories\CartItemRepository;
use Modules\Checkout\Http\Requests\CustomerAddressForm;
use Modules\API\Http\Resources\Sales\Order as OrderResource;
use Modules\API\Http\Resources\Checkout\Cart as CartResource;
use Modules\API\Http\Resources\Checkout\CartShippingRate as CartShippingRateResource;

class CheckoutController extends Controller
{
    /**
     * Contains current guard
     *
     * @var array
     */
    protected $guard;

    /**
     * CartRepository object
     *
     * @var \Modules\Checkout\Repositories\CartRepository
     */
    protected $cartRepository;

    /**
     * CartItemRepository object
     *
     * @var \Modules\Checkout\Repositories\CartItemRepository
     */
    protected $cartItemRepository;

    /**
     * Controller instance
     *
     * @param  \Modules\Checkout\Repositories\CartRepository  $cartRepository
     * @param  \Modules\Checkout\Repositories\CartItemRepository  $cartItemRepository
     * @param  \Modules\Sales\Repositories\OrderRepository  $orderRepository
     */
    public function __construct(
        CartRepository $cartRepository,
        CartItemRepository $cartItemRepository,
        OrderRepository $orderRepository
    )
    {
        $this->guard = request()->has('token') ? 'api' : 'customer';

        auth()->setDefaultDriver($this->guard);

        // $this->middleware('auth:' . $this->guard);

        $this->_config = request('_config');

        $this->cartRepository = $cartRepository;

        $this->cartItemRepository = $cartItemRepository;

        $this->orderRepository = $orderRepository;
    }

    /**
     * Saves customer address.
     *
     * @param  \Modules\Checkout\Http\Requests\CustomerAddressForm $request
     * @return \Illuminate\Http\Response
    */
    public function saveAddress(CustomerAddressForm $request)
    {
        $data = request()->all();

        $data['billing']['address1'] = implode(PHP_EOL, array_filter($data['billing']['address1']));

        $data['shipping']['address1'] = implode(PHP_EOL, array_filter($data['shipping']['address1']));

        if (isset($data['billing']['id']) && str_contains($data['billing']['id'], 'address_')) {
            unset($data['billing']['id']);
            unset($data['billing']['address_id']);
        }

        if (isset($data['shipping']['id']) && Str::contains($data['shipping']['id'], 'address_')) {
            unset($data['shipping']['id']);
            unset($data['shipping']['address_id']);
        }


        if (Cart::hasError() || ! Cart::saveCustomerAddress($data) || ! Shipping::collectRates()) {
            abort(400);
        }

        $rates = [];

        foreach (Shipping::getGroupedAllShippingRates() as $code => $shippingMethod) {
            $rates[] = [
                'carrier_title' => $shippingMethod['carrier_title'],
                'rates'         => CartShippingRateResource::collection(collect($shippingMethod['rates'])),
            ];
        }

        Cart::collectTotals();

        return response()->json([
            'data' => [
                'rates' => $rates,
                'cart'  => new CartResource(Cart::getCart()),
            ]
        ]);
    }

    /**
     * Saves shipping method.
     *
     * @return \Illuminate\Http\Response
    */
    public function saveShipping()
    {
        $shippingMethod = request()->get('shipping_method');

        if (Cart::hasError()
            || !$shippingMethod
            || ! Cart::saveShippingMethod($shippingMethod)
        ) {
            abort(400);
        }

        Cart::collectTotals();

        return response()->json([
            'data' => [
                'methods' => Payment::getPaymentMethods(),
                'cart'    => new CartResource(Cart::getCart()),
            ]
        ]);
    }

    /**
     * Saves payment method.
     *
     * @return \Illuminate\Http\Response
    */
    public function savePayment()
    {
        $payment = request()->get('payment');

        if (Cart::hasError() || ! $payment || ! Cart::savePaymentMethod($payment)) {
            abort(400);
        }

        return response()->json([
            'data' => [
                'cart' => new CartResource(Cart::getCart()),
            ]
        ]);
    }

    /**
     * Check for minimum order.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkMinimumOrder()
    {
        $minimumOrderAmount = (float) core()->getConfigData('sales.orderSettings.minimum-order.minimum_order_amount') ?? 0;

        $status = Cart::checkMinimumOrder();

        return response()->json([
            'status' => ! $status ? false : true,
            'message' => ! $status ? trans('shop::app.checkout.cart.minimum-order-message', ['amount' => core()->currency($minimumOrderAmount)]) : 'Success',
            'data' => [
                'cart'   => new CartResource($cart),
            ]
        ]);
    }

    /**
     * Saves order.
     *
     * @return \Illuminate\Http\Response
    */
    public function saveOrder()
    {
        if (Cart::hasError()) {
            abort(400);
        }

        Cart::collectTotals();

        $this->validateOrder();

        $cart = Cart::getCart();

        if ($redirectUrl = Payment::getRedirectUrl($cart)) {
            return response()->json([
                    'success'      => true,
                    'redirect_url' => $redirectUrl,
                ]);
        }

        $order = $this->orderRepository->create(Cart::prepareDataForOrder());

        Cart::deActivateCart();

        return response()->json([
            'success' => true,
            'order'   => new OrderResource($order),
        ]);
    }

    /**
     * Validate order before creation
     *
     * @throws Exception
     */
    public function validateOrder(): void
    {
        app(OnepageController::class)->validateOrder();
    }
}