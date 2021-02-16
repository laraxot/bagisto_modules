<?php

namespace Modules\Paypal\Http\Controllers;

use Modules\Checkout\Facades\Cart;
use Modules\Sales\Repositories\OrderRepository;
use Modules\Paypal\Helpers\Ipn;

class StandardController extends Controller
{
    /**
     * OrderRepository object
     *
     * @var \Modules\Sales\Repositories\OrderRepository
     */
    protected $orderRepository;

    /**
     * Ipn object
     *
     * @var \Modules\Paypal\Helpers\Ipn
     */
    protected $ipnHelper;

    /**
     * Create a new controller instance.
     *
     * @param  \Modules\Attribute\Repositories\OrderRepository  $orderRepository
     * @param  \Modules\Paypal\Helpers\Ipn  $ipnHelper
     * @return void
     */
    public function __construct(
        OrderRepository $orderRepository,
        Ipn $ipnHelper
    )
    {
        $this->orderRepository = $orderRepository;

        $this->ipnHelper = $ipnHelper;
    }

    /**
     * Redirects to the paypal.
     *
     * @return \Illuminate\View\View
     */
    public function redirect()
    {
        return view('paypal::standard-redirect');
    }

    /**
     * Cancel payment from paypal.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        session()->flash('error', 'Paypal payment has been canceled.');

        return redirect()->route('shop.checkout.cart.index');
    }

    /**
     * Success payment
     *
     * @return \Illuminate\Http\Response
     */
    public function success()
    {
        $order = $this->orderRepository->create(Cart::prepareDataForOrder());

        Cart::deActivateCart();

        session()->flash('order', $order);

        return redirect()->route('shop.checkout.success');
    }

    /**
     * Paypal Ipn listener
     *
     * @return \Illuminate\Http\Response
     */
    public function ipn()
    {
        $this->ipnHelper->processIpn(request()->all());
    }
}