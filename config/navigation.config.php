<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

return [
    'default'   => [
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
                    'route'      => 'admin/user',
                    'icon'       => 'user',
                    'permission' => 'admin.user',
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
                'profile'  => [
                    'label'      => 'Edit Profile',
                    'route'      => 'zfcuser/profile/edit',
                    'icon'       => 'edit',
                    'permission' => 'member',
                ],
                'settings' => [
                    'label'      => 'Change Settings',
                    'route'      => 'zfcuser/profile/settings',
                    'icon'       => 'cog',
                    'permission' => 'member',
                ],
                'logout'   => [
                    'label'      => 'Logout',
                    'route'      => 'zfcuser/logout',
                    'class'      => 'no-ajax',
                    'icon'       => 'off',
                    'divider'    => true,
                    'permission' => 'member',
                ],
            ],
        ],
    ],
];
