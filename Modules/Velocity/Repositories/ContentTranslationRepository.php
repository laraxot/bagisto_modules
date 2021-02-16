<?php

namespace Modules\Velocity\Repositories;

use Modules\Core\Eloquent\Repository;
use Prettus\Repository\Traits\CacheableRepository;

class ContentTranslationRepository extends Repository
{
    use CacheableRepository;

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return 'Modules\Velocity\Contracts\ContentTranslation';
    }
}