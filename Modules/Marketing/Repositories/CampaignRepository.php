<?php

namespace Modules\Marketing\Repositories;

use Modules\Core\Eloquent\Repository;

class CampaignRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Modules\Marketing\Contracts\Campaign';
    }
}