<?php

namespace Ise\Admin;

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
            'rbac'        => [
                'type'    => 'literal',
                'options' => [
                    'route'    => '/rbac',
                    'defaults' => [
                        'controller' => __NAMESPACE__ . '\Controller\Rbac',
                        'action'     => 'index',
                    ],
                ],
            ],
            'diagnostics' => [
                'type'    => 'literal',
                'options' => [
                    'route'    => '/diagnostics',
                    'defaults' => [
                        'controller' => 'ZFTool\Controller\Diagnostics',
                        'action'     => 'run',
                    ],
                ],
            ],
            'users'       => [
                'type'          => 'bread',
                'options'       => [
                    'route'    => '/users',
                    'defaults' => [
                        'controller' => __NAMESPACE__ . '\Controller\User',
                    ],
                ],
                'may_terminate' => true,
                'child_routes'  => [
                    'ban'   => [
                        'type'    => 'segment',
                        'options' => [
                            'route'       => '/ban/:id',
                            'constraints' => [
                                'id' => $uuidRegex,
                            ],
                            'defaults'    => [
                                'action' => 'ban'
                            ],
                        ],
                    ],
                    'unban' => [
                        'type'    => 'segment',
                        'options' => [
                            'route'       => '/unban/:id',
                            'constraints' => [
                                'id' => $uuidRegex,
                            ],
                            'defaults'    => [
                                'action' => 'unban'
                            ],
                        ],
                    ],
                ],
            ],
            'roles'       => [
                'type'    => 'bread',
                'options' => [
                    'route'    => '/roles',
                    'defaults' => [
                        'controller' => __NAMESPACE__ . '\Controller\Role',
                    ],
                ],
            ],
            'permissions' => [
                'type'    => 'bread',
                'options' => [
                    'route'    => '/permissions',
                    'defaults' => [
                        'controller' => __NAMESPACE__ . '\Controller\Permission',
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
                            'route'       => '/view/:id',
                            'constraints' => [
                                'id' => $uuidRegex,
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
