<?php

namespace Modules\Velocity\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Velocity\Contracts\Category as CategoryContract;

class Category extends Model implements CategoryContract
{
    
    protected $table = 'velocity_category';

    protected $fillable = [
        'category_id',
        'icon',
        'tooltip',
        'status',
    ];
}