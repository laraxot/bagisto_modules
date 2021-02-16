<?php

return [
    'simple'       => [
        'key'   => 'simple',
        'name'  => 'Simple',
        'class' => 'Modules\Product\Type\Simple',
        'sort'  => 1,
    ],

    'configurable' => [
        'key'   => 'configurable',
        'name'  => 'Configurable',
        'class' => 'Modules\Product\Type\Configurable',
        'sort'  => 2,
    ],

    'virtual'      => [
        'key'   => 'virtual',
        'name'  => 'Virtual',
        'class' => 'Modules\Product\Type\Virtual',
        'sort'  => 3,
    ],

    'grouped'      => [
        'key'   => 'grouped',
        'name'  => 'Grouped',
        'class' => 'Modules\Product\Type\Grouped',
        'sort'  => 4,
    ],

    'downloadable' => [
        'key'   => 'downloadable',
        'name'  => 'Downloadable',
        'class' => 'Modules\Product\Type\Downloadable',
        'sort'  => 5,
    ],
    
    'bundle'       => [
        'key'  => 'bundle',
        'name'  => 'Bundle',
        'class' => 'Modules\Product\Type\Bundle',
        'sort'  => 6,
    ]
];