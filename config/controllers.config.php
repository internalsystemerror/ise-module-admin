<?php

namespace Ise\Admin;

use Ise\Bread\Controller\Factory\AbstractActionControllerFactory;

return [
    'aliases'    => [
        __NAMESPACE__ . '\Controller\User'        => Controller\UserController::class,
        __NAMESPACE__ . '\Controller\Role'        => Controller\RoleController::class,
        __NAMESPACE__ . '\Controller\Permission'  => Controller\PermissionController::class,
        __NAMESPACE__ . '\Controller\Rbac'        => Controller\RbacController::class,
        __NAMESPACE__ . '\Controller\Profile'     => Controller\ProfileController::class,
        __NAMESPACE__ . '\Controller\Diagnostics' => Controller\DiagnosticsController::class,
        'ZFTool\Controller\Diagnostics'           => __NAMESPACE__ . '\Controller\Diagnostics',
    ],
    'factories'  => [
        Controller\UserController::class        => AbstractActionControllerFactory::class,
        Controller\RoleController::class        => AbstractActionControllerFactory::class,
        Controller\PermissionController::class  => AbstractActionControllerFactory::class,
        Controller\RbacController::class        => Controller\Factory\RbacControllerFactory::class,
        Controller\ProfileController::class     => Controller\Factory\ProfileControllerFactory::class,
        Controller\DiagnosticsController::class => Controller\Factory\DiagnosticsControllerFactory::class,
    ],
    'invokables' => [
        __NAMESPACE__ . '\Controller\Admin'   => Controller\AdminController::class,
        __NAMESPACE__ . '\Controller\Index'   => Controller\IndexController::class,
        __NAMESPACE__ . '\Controller\Console' => Controller\ConsoleController::class,
    ],
];
