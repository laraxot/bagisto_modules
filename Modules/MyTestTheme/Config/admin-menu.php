<?php

return [
    [
        'key'        => 'myTestTheme',
        'name'       => 'myTestTheme::app.admin.layouts.myTestTheme',
        'route'      => 'myTestTheme.admin.content.index',
        'sort'       => 5,
        'icon-class' => 'myTestTheme-icon',
    ], [
        'key'        => 'myTestTheme.meta-data',
        'name'       => 'myTestTheme::app.admin.layouts.meta-data',
        'route'      => 'myTestTheme.admin.meta-data',
        'sort'       => 1,
        'icon-class' => '',
    ], [
        'key'        => 'myTestTheme.header',
        'name'       => 'myTestTheme::app.admin.layouts.header-content',
        'route'      => 'myTestTheme.admin.content.index',
        'sort'       => 2,
        'icon-class' => '',
    ],
];