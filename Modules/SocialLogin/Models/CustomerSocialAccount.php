<?php

namespace Modules\SocialLogin\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Customer\Models\CustomerProxy;
use Modules\SocialLogin\Contracts\CustomerSocialAccount as CustomerSocialAccountContract;

class CustomerSocialAccount extends Model implements CustomerSocialAccountContract
{
    protected $fillable = [
        'customer_id',
        'provider_name',
        'provider_id',
    ];

    /**
     * Get the customer that belongs to the social aoount.
     */
    public function customer()
    {
        return $this->belongsTo(CustomerProxy::modelClass());
    }
}