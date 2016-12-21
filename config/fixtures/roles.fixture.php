<?php
return [
    'admin' => [
        'description' => 'Administrator',
        'permissions' => [
            'admin',
            'admin.diagnostics',
            'admin.users',
            'admin.users.browse',
            'admin.users.read',
            'admin.users.add',
            'admin.users.edit',
            'admin.users.delete',
            'admin.users.enable',
            'admin.users.disable',
            'admin.users.ban',
            'admin.users.unban',
            'admin.rbac',
            'admin.rbac.roles',
            'admin.rbac.roles.browse',
            'admin.rbac.roles.read',
            'admin.rbac.roles.add',
            'admin.rbac.roles.edit',
            'admin.rbac.roles.delete',
            'admin.rbac.roles.enable',
            'admin.rbac.roles.disable',
            'admin.rbac.permissions',
            'admin.rbac.permissions.browse',
            'admin.rbac.permissions.read',
            'admin.rbac.permissions.add',
            'admin.rbac.permissions.edit',
            'admin.rbac.permissions.delete',
            'admin.rbac.permissions.enable',
            'admin.rbac.permissions.disable',
        ],
        'children'    => [
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
