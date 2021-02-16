<?php

namespace Modules\Attribute\Repositories;

use Modules\Core\Eloquent\Repository;

class AttributeGroupRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Modules\Attribute\Contracts\AttributeGroup';
    }
}