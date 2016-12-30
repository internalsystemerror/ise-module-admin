<?php

namespace Ise\Admin;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'doctrine'      => [
        'driver'   => [
            'admin_annotation_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../src/Entity'
                ],
            ],
            'orm_default'             => [
                'drivers' => [
                    'Ise\Admin\Entity' => 'admin_annotation_driver',
                ],
            ],
        ],
        'fixtures' => [
            'admin_fixture' => __DIR__ . '/../src/Fixture',
        ],
    ],
    'view_manager'  => [
        'template_map'        => [
            'layout/admin'  => __DIR__ . '/../view/layout/admin.phtml',
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'layout/login'  => __DIR__ . '/../view/layout/login.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'console'       => [
        'router' => [
            'routes' => [
                'install' => [
                    'options' => [
                        'route'    => 'install',
                        'defaults' => [
                            'controller' => __NAMESPACE__ . '\Controller\Console',
                            'action'     => 'install',
                        ],
                    ],
                ],
                'update'  => [
                    'options' => [
                        'route'    => 'update',
                        'defaults' => [
                            'controller' => __NAMESPACE__ . '\Controller\Console',
                            'action'     => 'update',
                        ],
                    ],
                ],
                'refresh' => [
                    'options' => [
                        'route'    => 'refresh',
                        'defaults' => [
                            'controller' => __NAMESPACE__ . '\Controller\Console',
                            'action'     => 'refresh',
                        ],
                    ],
                ],
            ],
        ],
    ],
    'asset_manager' => include __DIR__ . '/assets.config.php',
    'router'        => include __DIR__ . '/router.config.php',
    'navigation'    => include __DIR__ . '/navigation.config.php',
    'zfc_rbac'      => include __DIR__ . '/zfcrbac.config.php',
    'zfcuser'       => include __DIR__ . '/zfcuser.config.php',
];
