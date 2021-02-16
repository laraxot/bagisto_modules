<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Contracts\ChannelTranslation as ChannelTranslationContract;

class ChannelTranslation extends Model implements ChannelTranslationContract
{
    protected $guarded = [];
}