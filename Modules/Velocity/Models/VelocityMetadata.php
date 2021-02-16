<?php

namespace Modules\Velocity\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Velocity\Contracts\VelocityMetadata as VelocityMetadataContract;

class VelocityMetadata extends Model implements VelocityMetadataContract
{
    protected $table = 'velocity_meta_data';

    protected $guarded = [];

}