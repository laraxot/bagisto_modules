<?php

namespace Modules\CartRule\Listeners;

use Modules\CartRule\Helpers\CartRule;

class Cart
{
    /**
     * CartRule object
     *
     * @var \Modules\CartRule\Helpers\CartRule
     */
    protected $cartRuleHepler;

    /**
     * Create a new listener instance.
     *
     * @param  \Modules\CartRule\Repositories\CartRule  $cartRuleHepler
     * @return void
     */
    public function __construct(CartRule $cartRuleHepler)
    {
        $this->cartRuleHepler = $cartRuleHepler;
    }

    /**
     * Aplly valid cart rules to cart
     * 
     * @param  \Modules\Checkout\Contracts\Cart  $cart
     * @return void
     */
    public function applyCartRules($cart)
    {
        $this->cartRuleHepler->collect();
    }
}