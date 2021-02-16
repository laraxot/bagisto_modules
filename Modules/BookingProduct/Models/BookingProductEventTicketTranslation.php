<?php

namespace Modules\BookingProduct\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\BookingProduct\Contracts\BookingProductEventTicketTranslation as BookingProductEventTicketTranslationContract;

class BookingProductEventTicketTranslation extends Model implements BookingProductEventTicketTranslationContract
{
    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'description',
    ];
}