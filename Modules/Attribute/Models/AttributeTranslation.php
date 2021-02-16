<?php

namespace Modules\Attribute\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Attribute\Contracts\AttributeTranslation as AttributeTranslationContract;

class AttributeTranslation extends Model implements AttributeTranslationContract
{
    public $timestamps = false;

    protected $fillable = ['name'];
}