<?php

namespace Modules\GDPR\Repositories;

use Illuminate\Container\Container;
use Modules\Core\Eloquent\Repository;

class GDPRDataRequestRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return 'Modules\GDPR\Contracts\GDPRDataRequest';
    }

    public function __construct(
        Container $container
    ) {
        parent::__construct($container);
    }
}