<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Customer\Models\CustomerProxy;
use Modules\Core\Contracts\SubscribersList as SubscribersListContract;

class SubscribersList extends Model implements SubscribersListContract
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'subscribers_list';

    protected $fillable = [
        'email',
        'is_subscribed',
        'token',
        'customer_id',
        'channel_id',
    ];

    protected $hidden = ['token'];

    /**
     * Get the customer associated with the subscription.
     */
    public function customer()
    {
        return $this->belongsTo(CustomerProxy::modelClass());
    }
}