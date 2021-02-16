<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Product\Contracts\ProductDownloadableSampleTranslation as ProductDownloadableSampleTranslationContract;

class ProductDownloadableSampleTranslation extends Model implements ProductDownloadableSampleTranslationContract
{
    public $timestamps = false;

    protected $fillable = ['title'];
}