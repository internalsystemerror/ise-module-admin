<?php
return [
    'admin' => [
        'description' => 'Administrator',
        'permissions' => [
            'admin',
        ],
        'children'    => [
            'user_admin' => [
                'description' => 'User Admin',
                'permissions' => [
                    'admin',
                    'admin.user',
                    'admin.user.add',
                    'admin.user.edit',
                    'admin.user.delete',
                    'admin.user.enable',
                    'admin.user.disable',
                    'admin.user.ban',
                    'admin.user.unban',
                ],
            ],
            'rbac_admin' => [
                'description' => 'RBAC Admin',
                'permissions' => [
                    'admin',
                    'admin.rbac',
                    'admin.rbac.role',
                    'admin.rbac.role.add',
                    'admin.rbac.role.edit',
                    'admin.rbac.role.delete',
                    'admin.rbac.role.enable',
                    'admin.rbac.role.disable',
                    'admin.rbac.permission',
                    'admin.rbac.permission.add',
                    'admin.rbac.permission.edit',
                    'admin.rbac.permission.delete',
                    'admin.rbac.permission.enable',
                    'admin.rbac.permission.disable',
                ],
            ],
            'member' => [
                'description' => 'Logged in member',
                'permissions' => [
                    'member',
                ],
                'children'    => [
                    'guest' => 'Guest visitor',
                ],
            ],
        ],
    ],
];
