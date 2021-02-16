<?php

namespace Modules\Tax\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Tax\Models\TaxCategory;
use Modules\Tax\Models\TaxRate;
use Modules\Tax\Contracts\TaxMap as TaxMapContract;

class TaxMap extends Model implements TaxMapContract
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'tax_categories_tax_rates';

    protected $fillable = [
       'tax_category_id',
       'tax_rate_id',
    ];

}