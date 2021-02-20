<?php

return [
    [
        'key'   => 'myTestTheme',
        'name'  => 'myTestTheme::app.admin.layouts.myTestTheme',
        'route' => 'myTestTheme.admin.meta-data',
        'sort'  => 5,
    ],
    [
        'key'   => 'myTestTheme.meta-data',
        'name'  => 'myTestTheme::app.admin.layouts.meta-data',
        'route' => 'myTestTheme.admin.meta-data',
        'sort'  => 5,
    ],
    [
        'key'   => 'myTestTheme.meta-data.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => 'myTestTheme.admin.store.meta-data',
        'sort'  => 1,
    ],
    [
        'key'   => 'myTestTheme.header',
        'name'  => 'myTestTheme::app.admin.layouts.header-content',
        'route' => 'myTestTheme.admin.content.index',
        'sort'  => 5,
    ],
    [
        'key'   => 'myTestTheme.header.create',
        'name'  => 'admin::app.acl.create',
        'route' => 'myTestTheme.admin.content.create',
        'sort'  => 1,
    ], [
        'key'   => 'myTestTheme.header.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => 'myTestTheme.admin.content.edit',
        'sort'  => 2,
    ], [
        'key'   => 'myTestTheme.header.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => 'myTestTheme.admin.content.delete',
        'sort'  => 3,
    ]
];