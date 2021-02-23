<?php

namespace Modules\MyTestTheme\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\MyTestTheme\Contracts\myTestThemeCustomerCompareProduct as myTestThemeCustomerCompareProductContract;

class MyTestThemeCustomerCompareProduct extends Model implements myTestThemeCustomerCompareProductContract
{
    protected $guarded = [];
}