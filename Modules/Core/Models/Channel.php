<?php

namespace Modules\Core\Models;

use Illuminate\Support\Facades\Storage;
use Modules\Category\Models\CategoryProxy;
use Modules\Core\Eloquent\TranslatableModel;
use Modules\Inventory\Models\InventorySourceProxy;
use Modules\Core\Contracts\Channel as ChannelContract;

class Channel extends TranslatableModel implements ChannelContract
{
    protected $fillable = [
        'code',
        'name',
        'description',
        'theme',
        'home_page_content',
        'footer_content',
        'hostname',
        'default_locale_id',
        'base_currency_id',
        'root_category_id',
        'home_seo',
        'is_maintenance_on',
        'maintenance_mode_text',
        'allowed_ips'
    ];

    public $translatedAttributes = [
        'name',
        'description',
        'home_page_content',
        'footer_content',
        'maintenance_mode_text',
        'home_seo',
    ];

    /**
     * Get the channel locales.
     */
    public function locales()
    {
        return $this->belongsToMany(LocaleProxy::modelClass(), 'channel_locales');
    }

    /**
     * Get the default locale
     */
    public function default_locale()
    {
        return $this->belongsTo(LocaleProxy::modelClass());
    }

    /**
     * Get the channel locales.
     */
    public function currencies()
    {
        return $this->belongsToMany(CurrencyProxy::modelClass(), 'channel_currencies');
    }

    /**
     * Get the channel inventory sources.
     */
    public function inventory_sources()
    {
        return $this->belongsToMany(InventorySourceProxy::modelClass(), 'channel_inventory_sources');
    }

    /**
     * Get the base currency
     */
    public function base_currency()
    {
        return $this->belongsTo(CurrencyProxy::modelClass());
    }

    /**
     * Get the base currency
     */
    public function root_category()
    {
        return $this->belongsTo(CategoryProxy::modelClass(), 'root_category_id');
    }

    /**
     * Get logo image url.
     */
    public function logo_url()
    {
        if (! $this->logo) {
            return;
        }

        return Storage::url($this->logo);
    }

    /**
     * Get logo image url.
     */
    public function getLogoUrlAttribute()
    {
        return $this->logo_url();
    }

    /**
     * Get favicon image url.
     */
    public function favicon_url()
    {
        if (! $this->favicon) {
            return;
        }

        return Storage::url($this->favicon);
    }

    /**
     * Get favicon image url.
     */
    public function getFaviconUrlAttribute()
    {
        return $this->favicon_url();
    }
}