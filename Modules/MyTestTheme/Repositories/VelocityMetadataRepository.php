<?php

namespace Modules\MyTestTheme\Repositories;

use Modules\Core\Eloquent\Repository;

class MyTestThemeMetadataRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return 'Modules\myTestTheme\Contracts\myTestThemeMetadata';
    }
}