<?php
    use Modules\Shipping\Shipping;
    
    if (! function_exists('shipping')) {
        function shipping()
        {
            return new Shipping;
        }
    }
?>