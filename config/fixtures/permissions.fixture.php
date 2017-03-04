<?php

use Ise\Bread\EventManager\BreadEvent;

return [
    'admin'  => [
        'description' => 'Administration access',
        'children'    => [
            'user' => [
                'description' => 'User administration access',
                'children'    => [
                    BreadEvent::ACTION_CREATE  => 'Add a new user',
                    BreadEvent::ACTION_UPDATE  => 'Edit an existing user',
                    BreadEvent::ACTION_DELETE  => 'Delete an existing user',
                    BreadEvent::ACTION_ENABLE  => 'Enable a user',
                    BreadEvent::ACTION_DISABLE => 'Disable a user',
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
                            BreadEvent::ACTION_CREATE  => 'Add a new role',
                            BreadEvent::ACTION_UPDATE  => 'Edit an existing role',
                            BreadEvent::ACTION_DELETE  => 'Delete an existing role',
                            BreadEvent::ACTION_ENABLE  => 'Enable a role',
                            BreadEvent::ACTION_DISABLE => 'Disable a role',
                        ],
                    ],
                    'permission' => [
                        'description' => 'Permission administration access',
                        'children'    => [
                            BreadEvent::ACTION_CREATE  => 'Add a new permission',
                            BreadEvent::ACTION_UPDATE  => 'Edit an existing permission',
                            BreadEvent::ACTION_DELETE  => 'Delete an existing permission',
                            BreadEvent::ACTION_ENABLE  => 'Enable a permission',
                            BreadEvent::ACTION_DISABLE => 'Disable a permission',
                        ],
                    ],
                ],
            ],
        ],
    ],
    'member' => 'Member access'
];
