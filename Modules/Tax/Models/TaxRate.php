<?php

namespace Modules\Tax\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Tax\Models\TaxCategory;
use Modules\Tax\Contracts\TaxRate as TaxRateContract;

class TaxRate extends Model implements TaxRateContract
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'tax_rates';

    protected $fillable = [
        'identifier',
        'is_zip',
        'zip_code',
        'zip_from',
        'zip_to',
        'state',
        'country',
        'tax_rate',
    ];

    public function tax_categories()
    {
        return $this->belongsToMany(TaxCategoryProxy::modelClass(), 'tax_categories_tax_rates', 'tax_rate_id', 'id');
    }
}