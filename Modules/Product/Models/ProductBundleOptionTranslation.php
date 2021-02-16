<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Product\Contracts\ProductBundleOptionTranslation as ProductBundleOptionTranslationContract;

class ProductBundleOptionTranslation extends Model implements ProductBundleOptionTranslationContract
{
    public $timestamps = false;

    protected $fillable = ['label'];
}