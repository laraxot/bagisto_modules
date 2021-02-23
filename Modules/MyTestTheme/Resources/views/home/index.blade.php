@php
dd([
    'vars' => get_defined_vars(),
    'hints' => \View::getFinder()->getHints(),
    'line' => __LINE__,
    'file' => __FILE__,
]);
@endphp
