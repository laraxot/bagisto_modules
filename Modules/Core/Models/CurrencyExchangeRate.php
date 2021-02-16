<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Contracts\CurrencyExchangeRate as CurrencyExchangeRateContract;

class CurrencyExchangeRate extends Model implements CurrencyExchangeRateContract
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'target_currency',
        'rate',
    ];
}