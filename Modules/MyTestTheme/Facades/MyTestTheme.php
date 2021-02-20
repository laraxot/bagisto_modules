<?php

namespace Modules\MyTestTheme\Facades;

use Illuminate\Support\Facades\Facade;

class MyTestTheme extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'myTestTheme';
    }
}