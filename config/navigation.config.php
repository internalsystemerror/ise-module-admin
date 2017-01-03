<?php
return [
    'default'      => [
        'index' => [
            'label'      => 'Dashboard',
            'route'      => 'admin',
            'icon'       => 'dashboard',
            'order'      => -1000,
            'permission' => 'member',
        ],
        'admin' => [
            'label'      => 'Administration',
            'uri'        => '#',
            'icon'       => 'lock',
            'order'      => 1,
            'permission' => 'admin',
            'pages'      => [
                'users' => [
                    'label'      => 'User Accounts',
                    'route'      => 'admin/users',
                    'icon'       => 'user',
                    'permission' => 'admin.users',
                ],
                'rbac'  => [
                    'label'      => 'Role Based Access Control',
                    'route'      => 'admin/rbac',
                    'icon'       => 'tower',
                    'permission' => 'admin.rbac',
                ],
            ],
        ],
    ],
    'user_menu' => [
        'menu' => [
            'label'      => '',
            'uri'        => '#',
            'icon'       => 'user',
            'order'      => 1000,
            'permission' => 'member',
            'pages'      => [
                'profile'     => [
                    'label'      => 'Edit Profile',
                    'route'      => 'zfcuser/profile/edit',
                    'icon'       => 'edit',
                    'permission' => 'member',
                ],
                'settings'    => [
                    'label'      => 'Change Settings',
                    'route'      => 'zfcuser/profile/settings',
                    'icon'       => 'cog',
                    'permission' => 'member',
                ],
                'diagnostics' => [
                    'label'      => 'Site Diagnostics',
                    'route'      => 'admin/diagnostics',
                    'icon'       => 'plus',
                    'permission' => 'admin.diagnostics',
                ],
                'logout'      => [
                    'label'      => 'Logout',
                    'route'      => 'zfcuser/logout',
                    'icon'       => 'off',
                    'divider'    => true,
                    'permission' => 'member',
                ],
            ],
        ],
    ],
];
