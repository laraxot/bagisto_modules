<?php

namespace Modules\MyTestTheme\Models;

use Modules\Core\Eloquent\TranslatableModel;
use Modules\myTestTheme\Contracts\Content as ContentContract;

class Content extends TranslatableModel implements ContentContract
{
    
    protected $table = 'myTestTheme_contents';

    public $translatedAttributes = [
        'title',
        'custom_title',
        'custom_heading',
        'page_link',
        'link_target',
        'catalog_type',
        'products',
        'description',
    ];

    protected $fillable = [
        'content_type',
        'position',
        'status',
    ];

    protected $with = ['translations'];
}