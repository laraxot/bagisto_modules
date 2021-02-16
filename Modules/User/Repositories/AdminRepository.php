<?php

namespace Modules\User\Repositories;

use Modules\Core\Eloquent\Repository;

class AdminRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Modules\User\Contracts\Admin';
    }
}