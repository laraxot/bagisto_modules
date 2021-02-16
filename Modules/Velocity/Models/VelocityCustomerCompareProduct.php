<?php

namespace Modules\Velocity\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Velocity\Contracts\VelocityCustomerCompareProduct as VelocityCustomerCompareProductContract;

class VelocityCustomerCompareProduct extends Model implements VelocityCustomerCompareProductContract
{
    protected $guarded = [];
}