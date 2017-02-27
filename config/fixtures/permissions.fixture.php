<?php

use Ise\Bread\Router\Http\Bread;

return [
    'admin'  => [
        'description' => 'Administration access',
        'children'    => [
            'user' => [
                'description' => 'User administration access',
                'children'    => [
                    Bread::ACTION_CREATE  => 'Add a new user',
                    Bread::ACTION_UPDATE  => 'Edit an existing user',
                    Bread::ACTION_DELETE  => 'Delete an existing user',
                    Bread::ACTION_ENABLE  => 'Enable a user',
                    Bread::ACTION_DISABLE => 'Disable a user',
                    'ban'                 => 'Ban a user',
                    'unban'               => 'Unban a user',
                ],
            ],
            'rbac'  => [
                'description' => 'Role based access control',
                'children'    => [
                    'role'       => [
                        'description' => 'Role administration access',
                        'children'    => [
                            Bread::ACTION_CREATE  => 'Add a new role',
                            Bread::ACTION_UPDATE  => 'Edit an existing role',
                            Bread::ACTION_DELETE  => 'Delete an existing role',
                            Bread::ACTION_ENABLE  => 'Enable a role',
                            Bread::ACTION_DISABLE => 'Disable a role',
                        ],
                    ],
                    'permission' => [
                        'description' => 'Permission administration access',
                        'children'    => [
                            Bread::ACTION_CREATE  => 'Add a new permission',
                            Bread::ACTION_UPDATE  => 'Edit an existing permission',
                            Bread::ACTION_DELETE  => 'Delete an existing permission',
                            Bread::ACTION_ENABLE  => 'Enable a permission',
                            Bread::ACTION_DISABLE => 'Disable a permission',
                        ],
                    ],
                ],
            ],
        ],
    ],
    'member' => 'Member access'
];
