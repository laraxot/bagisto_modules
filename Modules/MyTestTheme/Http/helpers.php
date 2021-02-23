<?php

    use Modules\MyTestTheme\myTestTheme;

    if (!function_exists('myTestTheme')) {
        function myTestTheme()
        {
            return app()->make(myTestTheme::class);
        }
    }
