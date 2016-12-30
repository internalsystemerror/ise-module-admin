<?php
return [
    'admin'  => [
        'description' => 'Administration access',
        'children'    => [
            'diagnostics' => 'Run site diagnostics',
            'users'       => [
                'description' => 'User administration access',
                'children'    => [
                    'add'     => 'Add a new user',
                    'edit'    => 'Edit an existing user',
                    'delete'  => 'Delete an existing user',
                    'enable'  => 'Enable a user',
                    'disable' => 'Disable a user',
                    'ban'     => 'Ban a user',
                    'unban'   => 'Unban a user',
                ],
            ],
            'rbac'        => [
                'description' => 'Role based access control',
                'children'    => [
                    'roles'       => [
                        'description' => 'Role administration access',
                        'children'    => [
                            'add'     => 'Add a new role',
                            'edit'    => 'Edit an existing role',
                            'delete'  => 'Delete an existing role',
                            'enable'  => 'Enable a role',
                            'disable' => 'Disable a role',
                        ],
                    ],
                    'permissions' => [
                        'description' => 'Permission administration access',
                        'children'    => [
                            'add'     => 'Add a new permission',
                            'edit'    => 'Edit an existing permission',
                            'delete'  => 'Delete an existing permission',
                            'enable'  => 'Enable a permission',
                            'disable' => 'Disable a permission',
                        ],
                    ],
                ],
            ],
        ],
    ],
    'member' => 'Member access'
];
