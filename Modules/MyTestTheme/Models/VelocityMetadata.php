<?php

namespace Modules\MyTestTheme\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\myTestTheme\Contracts\myTestThemeMetadata as myTestThemeMetadataContract;

class MyTestThemeMetadata extends Model implements myTestThemeMetadataContract
{
    protected $table = 'myTestTheme_meta_data';

    protected $guarded = [];

}