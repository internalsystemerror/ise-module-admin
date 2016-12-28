<?php

namespace Ise\Admin;

return [
    'routes' => [
        'admin'   => [
            'type'          => 'hostname',
            'options'       => [
                'route' => 'admin.' . APPLICATION_DOMAIN,
            ],
            'may_terminate' => false,
            'child_routes'  => [
                'index'       => [
                    'type'    => 'literal',
                    'options' => [
                        'route'    => '/',
                        'defaults' => [
                            'controller' => __NAMESPACE__ . '\Controller\Index',
                            'action'     => 'index',
                        ],
                    ],
                ],
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
                                    'id' => '[1-9]{1}[0-9]*',
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
                                    'id' => '[1-9]{1}[0-9]*',
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
            'type'          => 'hostname',
            'options'       => [
                'route'    => 'admin.' . APPLICATION_DOMAIN,
                'defaults' => null,
            ],
            'may_terminate' => false,
            'child_routes'  => [
                'dashboard' => [
                    'type'    => 'literal',
                    'options' => [
                        'route'    => '/',
                        'defaults' => [
                            'controller' => __NAMESPACE__ . '\Controller\Index',
                            'action'     => 'dashboard',
                        ],
                    ],
                ],
                'profile'   => [
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
                                    'id' => '[1-9]{1}[0-9]*',
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
    ],
];
