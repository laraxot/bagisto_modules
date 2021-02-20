<?php

namespace Modules\MyTestTheme\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\myTestTheme\Contracts\Category as CategoryContract;

class Category extends Model implements CategoryContract
{
    
    protected $table = 'myTestTheme_category';

    protected $fillable = [
        'category_id',
        'icon',
        'tooltip',
        'status',
    ];
}