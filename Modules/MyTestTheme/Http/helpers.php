<?php

    use Modules\myTestTheme\myTestTheme;

    if (! function_exists('myTestTheme')) {
        function myTestTheme()
        {
            return app()->make(myTestTheme::class);
        }
    }
?>