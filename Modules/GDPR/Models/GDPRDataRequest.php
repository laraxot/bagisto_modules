<?php

namespace Modules\GDPR\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\GDPR\Contracts\GDPRDataRequest as GDPRDataRequestContract;

class GDPRDataRequest extends Model implements GDPRDataRequestContract
{
    protected $table = 'gdpr_data_request';
    protected $fillable = [
        'customer_id',
        'email',
        'request_status',
        'request_type',
        'message'  
    ];

}
