<?php

return [
    [
        'key'  => 'myTestTheme',
        'name' => 'myTestTheme::app.admin.system.myTestTheme.extension_name',
        'sort' => 2,
    ], [
        'key'  => 'myTestTheme.configuration',
        'name' => 'myTestTheme::app.admin.system.myTestTheme.settings',
        'sort' => 1,
    ], [
        'key'   => 'myTestTheme.configuration.general',
        'name'  => 'myTestTheme::app.admin.system.myTestTheme.general',
        'sort'  => 1,
        'fields' => [
            [
                'name'    => 'status',
                'title'   => 'myTestTheme::app.admin.system.general.status',
                'type'    => 'select',
                'options' => [
                    [
                        'title' => 'myTestTheme::app.admin.system.general.active',
                        'value' => true,
                    ], [
                        'title' => 'myTestTheme::app.admin.system.general.inactive',
                        'value' => false,
                    ]
                ]
            ]
        ]
    ],  [
        'key'    => 'myTestTheme.configuration.category',
        'name'   => 'myTestTheme::app.admin.system.myTestTheme.category',
        'sort'   => 1,
        'fields' => [
            [
                'name'    => 'icon_status',
                'title'   => 'myTestTheme::app.admin.system.category.icon-status',
                'type'    => 'select',
                'options' => [
                    [
                        'title' => 'myTestTheme::app.admin.system.category.active',
                        'value' => true,
                    ], [
                        'title' => 'myTestTheme::app.admin.system.category.inactive',
                        'value' => false,
                    ]
                ]
            ],  [
                'name'    => 'image_status',
                'title'   => 'myTestTheme::app.admin.system.category.image-status',
                'type'    => 'select',
                'options' => [
                    [
                        'title' => 'myTestTheme::app.admin.system.category.active',
                        'value' => true,
                    ], [
                        'title' => 'myTestTheme::app.admin.system.category.inactive',
                        'value' => false,
                    ]
                ]
            ],  [
                'name'          => 'image_height',
                'title'         => 'myTestTheme::app.admin.system.category.image-height',
                'type'          => 'depands',
                'depand'        => 'image_status:true',
                'validation'    => 'numeric|max:3',
                'channel_based' => false,
                'locale_based'  => false,
            ],  [
                'name'          => 'image_width',
                'title'         => 'myTestTheme::app.admin.system.category.image-width',
                'type'          => 'depands',
                'depand'        => 'image_status:true',
                'validation'    => 'numeric|max:3',
                'channel_based' => false,
                'locale_based'  => false,
            ],  [
                'name'          => 'image_alignment',
                'title'         => 'myTestTheme::app.admin.system.category.image-alignment',
                'channel_based' => false,
                'locale_based'  => false,
                'type'          => 'depands',
                'depand'        => 'image_status:true',
                'options'       => [
                    [
                        'title' => 'Right',
                        'value' => 'right',
                    ], [
                        'title' => 'Left',
                        'value' => 'left',
                    ]
                ]
            ],  [
                'name'    => 'tooltip_status',
                'title'   => 'myTestTheme::app.admin.system.category.show-tooltip',
                'type'    => 'select',
                'options' => [
                    [
                        'title' => 'myTestTheme::app.admin.system.category.active',
                        'value' => true,
                    ], [
                        'title' => 'myTestTheme::app.admin.system.category.inactive',
                        'value' => false,
                    ]
                ]
            ],  [
                'name'          => 'sub_category',
                'title'         => 'myTestTheme::app.admin.system.category.sub-category-show',
                'channel_based' => false,
                'locale_based'  => false,
                'type'          => 'select',
                'options'       => [
                    [
                        'title' => 'All',
                        'value' => 'all',
                    ], [
                        'title' => 'Custom',
                        'value' => 'custom',
                    ]
                ]
            ],  [
                'name'          => 'sub_category_num',
                'title'         => 'myTestTheme::app.admin.system.category.num-sub-category',
                'channel_based' => false,
                'locale_based'  => false,
                'type'          => 'depands',
                'depand'        => 'sub_category:custom',
                'validation'    => 'numeric|max:2',
            ]
        ]
    ]
];