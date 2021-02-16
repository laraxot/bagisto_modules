<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Contracts\CountryTranslation as CountryTranslationContract;

class CountryTranslation extends Model implements CountryTranslationContract
{
    public $timestamps = false;

    protected $fillable = ['name'];
}