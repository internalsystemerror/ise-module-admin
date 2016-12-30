<?php
return [
    'admin' => [
        'description' => 'Administrator',
        'permissions' => [
            'admin',
            'admin.diagnostics',
        ],
        'children'    => [
            'user_admin' => [
                'description' => 'User Admin',
                'permissions' => [
                    'admin',
                    'admin.users',
                    'admin.users.add',
                    'admin.users.edit',
                    'admin.users.delete',
                    'admin.users.enable',
                    'admin.users.disable',
                    'admin.users.ban',
                    'admin.users.unban',
                ],
            ],
            'rbac_admin' => [
                'description' => 'RBAC Admin',
                'permissions' => [
                    'admin',
                    'admin.rbac',
                    'admin.rbac.roles',
                    'admin.rbac.roles.add',
                    'admin.rbac.roles.edit',
                    'admin.rbac.roles.delete',
                    'admin.rbac.roles.enable',
                    'admin.rbac.roles.disable',
                    'admin.rbac.permissions',
                    'admin.rbac.permissions.add',
                    'admin.rbac.permissions.edit',
                    'admin.rbac.permissions.delete',
                    'admin.rbac.permissions.enable',
                    'admin.rbac.permissions.disable',
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
