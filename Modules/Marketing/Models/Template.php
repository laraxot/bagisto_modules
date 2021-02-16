<?php

namespace Modules\Marketing\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Product\Models\ProductProxy;
use Modules\Marketing\Contracts\Template as TemplateContract;

class Template extends Model implements TemplateContract
{
    protected $table = 'marketing_templates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'status',
        'content',
    ];
}