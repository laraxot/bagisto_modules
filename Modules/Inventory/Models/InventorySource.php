<?php

namespace Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Inventory\Contracts\InventorySource as InventorySourceContract;

class InventorySource extends Model implements InventorySourceContract
{
    protected $guarded = ['_token'];
}