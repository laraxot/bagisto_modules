<?php

namespace Modules\Checkout\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Checkout\Contracts\CartPayment as CartPaymentContract;

class CartPayment extends Model implements CartPaymentContract
{
    protected $table = 'cart_payment';
}