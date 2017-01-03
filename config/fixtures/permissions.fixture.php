<?php

use Ise\Bread\Router\Http\BreadRouteStack;

return [
    'admin'  => [
        'description' => 'Administration access',
        'children'    => [
            'users'       => [
                'description' => 'User administration access',
                'children'    => [
                    BreadRouteStack::ACTION_CREATE  => 'Add a new user',
                    BreadRouteStack::ACTION_UPDATE  => 'Edit an existing user',
                    BreadRouteStack::ACTION_DELETE  => 'Delete an existing user',
                    BreadRouteStack::ACTION_ENABLE  => 'Enable a user',
                    BreadRouteStack::ACTION_DISABLE => 'Disable a user',
                    'ban'                           => 'Ban a user',
                    'unban'                         => 'Unban a user',
                ],
            ],
            'rbac'        => [
                'description' => 'Role based access control',
                'children'    => [
                    'roles'       => [
                        'description' => 'Role administration access',
                        'children'    => [
                            BreadRouteStack::ACTION_CREATE  => 'Add a new role',
                            BreadRouteStack::ACTION_UPDATE  => 'Edit an existing role',
                            BreadRouteStack::ACTION_DELETE  => 'Delete an existing role',
                            BreadRouteStack::ACTION_ENABLE  => 'Enable a role',
                            BreadRouteStack::ACTION_DISABLE => 'Disable a role',
                        ],
                    ],
                    'permissions' => [
                        'description' => 'Permission administration access',
                        'children'    => [
                            BreadRouteStack::ACTION_CREATE  => 'Add a new permission',
                            BreadRouteStack::ACTION_UPDATE  => 'Edit an existing permission',
                            BreadRouteStack::ACTION_DELETE  => 'Delete an existing permission',
                            BreadRouteStack::ACTION_ENABLE  => 'Enable a permission',
                            BreadRouteStack::ACTION_DISABLE => 'Disable a permission',
                        ],
                    ],
                ],
            ],
        ],
    ],
    'member' => 'Member access'
];
