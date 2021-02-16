<?php
    use Modules\Checkout\Cart;

    if (! function_exists('cart')) {
        function cart()
        {
            return app()->make(Cart::class);
        }
    }