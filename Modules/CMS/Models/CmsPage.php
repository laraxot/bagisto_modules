<?php

namespace Modules\CMS\Models;

use Modules\Core\Eloquent\TranslatableModel;
use Modules\CMS\Contracts\CmsPage as CmsPageContract;
use Modules\Core\Models\ChannelProxy;

class CmsPage extends TranslatableModel implements CmsPageContract
{
    protected $fillable = ['layout'];

    public $translatedAttributes = [
        'content',
        'meta_description',
        'meta_title',
        'page_title',
        'meta_keywords',
        'html_content',
        'url_key',
    ];

    protected $with = ['translations'];

    /**
     * Get the channels.
     */
    public function channels()
    {
        return $this->belongsToMany(ChannelProxy::modelClass(), 'cms_page_channels');
    }
}