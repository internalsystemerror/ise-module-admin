<?php

namespace Ise\Admin;

use Ise\Bread\EventManager\BreadEvent;
use Zend\Validator\Uuid;

$uuidRegex = trim(Uuid::REGEX_UUID, '/^$');
return [
    'admin'   => [
        'type'          => 'literal',
        'options'       => [
            'route'    => '/admin',
            'defaults' => [
                'controller' => __NAMESPACE__ . '\Controller\Index',
                'action'     => 'index',
            ],
        ],
        'may_terminate' => true,
        'child_routes'  => [
            'rbac' => [
                'type'          => 'literal',
                'options'       => [
                    'route'    => '/rbac',
                    'defaults' => [
                        'controller' => __NAMESPACE__ . '\Controller\Rbac',
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes'  => [
                    'role'       => [
                        'type'    => 'bread',
                        'options' => [
                            'route'  => '/role',
                            'entity' => Entity\Role::class,
                        ],
                    ],
                    'permission' => [
                        'type'    => 'bread',
                        'options' => [
                            'route'  => '/permission',
                            'entity' => Entity\Permission::class,
                        ],
                    ],
                ],
            ],
            'user' => [
                'type'          => 'bread',
                'options'       => [
                    'route'  => '/user',
                    'entity' => Entity\User::class,
                ],
                'may_terminate' => true,
                'child_routes'  => [
                    'ban'   => [
                        'type'    => 'segment',
                        'options' => [
                            'route'       => '/:id/ban',
                            'constraints' => [
                                BreadEvent::IDENTIFIER => $uuidRegex,
                            ],
                            'defaults'    => [
                                'action' => 'ban'
                            ],
                        ],
                    ],
                    'unban' => [
                        'type'    => 'segment',
                        'options' => [
                            'route'       => '/:id/unban',
                            'constraints' => [
                                BreadEvent::IDENTIFIER => $uuidRegex,
                            ],
                            'defaults'    => [
                                'action' => 'unban'
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'zfcuser' => [
        'type'          => 'literal',
        'options'       => [
            'route' => '/admin',
        ],
        'may_terminate' => false,
        'child_routes'  => [
            'profile' => [
                'type'          => 'literal',
                'options'       => [
                    'route'    => '/profile',
                    'defaults' => [
                        'controller' => __NAMESPACE__ . '\Controller\Profile',
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes'  => [
                    'edit'     => [
                        'type'    => 'literal',
                        'options' => [
                            'route'    => '/edit',
                            'defaults' => [
                                'action' => 'edit'
                            ],
                        ],
                    ],
                    'view'     => [
                        'type'    => 'segment',
                        'options' => [
                            'route'       => '/:id/view',
                            'constraints' => [
                                BreadEvent::IDENTIFIER => $uuidRegex,
                            ],
                            'defaults'    => [
                                'action' => 'view'
                            ],
                        ],
                    ],
                    'settings' => [
                        'type'    => 'literal',
                        'options' => [
                            'route'    => '/settings',
                            'defaults' => [
                                'action' => 'settings',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
