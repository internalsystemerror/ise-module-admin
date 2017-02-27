<?php

namespace Ise\Admin;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Ise\Bread\Router\Http\Bread;

return [
    'ise'             => [
        'bread' => [
            'entities' => [
                Entity\Permission::class => [
                    'controller' => [
                        'baseClass'      => Controller\RbacBreadActionController::class,
                        'indexRoute'     => 'admin/rbac',
                        'basePermission' => 'admin.rbac.permission',
                        'templates'  => [
                            Bread::ACTION_UPDATE => 'ise/admin/permission/edit',
                            Bread::FORM_DIALOG   => 'ise/admin/rbac/dialog',
                        ],
                    ],
                ],
                Entity\Role::class       => [
                    'controller' => [
                        'baseClass'      => Controller\RbacBreadActionController::class,
                        'indexRoute'     => 'admin/rbac',
                        'basePermission' => 'admin.rbac.role',
                        'templates'  => [
                            Bread::ACTION_UPDATE => 'ise/admin/role/edit',
                            Bread::FORM_DIALOG   => 'ise/admin/rbac/dialog',
                        ],
                    ],
                ],
                Entity\User::class       => [
                    'controller' => [
                        'class'          => Controller\UserController::class,
                        'indexRoute'     => 'admin/user',
                        'basePermission' => 'admin.user',
                        'templates'  => [
                            Bread::ACTION_INDEX => 'ise/admin/user/browse',
                        ],
                    ],
                    'service'    => Service\UserService::class,
                ],
            ],
        ],
    ],
    'doctrine'        => [
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
    'view_manager'    => [
        'template_map'        => [
            'layout/admin'  => __DIR__ . '/../view/layout/admin.phtml',
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'layout/login'  => __DIR__ . '/../view/layout/login.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'asset_manager'   => include __DIR__ . '/assets.config.php',
    'controllers'     => include __DIR__ . '/controllers.config.php',
    'navigation'      => include __DIR__ . '/navigation.config.php',
    'router'          => ['routes' => include __DIR__ . '/routes.config.php'],
    'service_manager' => include __DIR__ . '/services.config.php',
    'view_helpers'    => include __DIR__ . '/helpers.config.php',
    'zfc_rbac'        => include __DIR__ . '/zfcrbac.config.php',
    'zfcuser'         => include __DIR__ . '/zfcuser.config.php',
];
