<?php

namespace IseAdmin;

use IseAdmin\Controller\ConsoleController;
use IseAdmin\Controller\DiagnosticsController;
use IseAdmin\Controller\IndexController;
use IseAdmin\Controller\RbacController;
use IseAdmin\Controller\RoleController;
use IseAdmin\Controller\PermissionController;
use IseAdmin\Controller\ProfileController;
use IseAdmin\Controller\UserController;
use IseAdmin\Controller\Factory\DiagnosticsControllerFactory;
use IseAdmin\Controller\Factory\ProfileControllerFactory;
use IseAdmin\Controller\Factory\RbacControllerFactory;
use IseBread\Controller\Factory\AbstractActionControllerFactory;

return [
    'aliases'    => [
        __NAMESPACE__ . '\Controller\User'        => UserController::class,
        __NAMESPACE__ . '\Controller\Role'        => RoleController::class,
        __NAMESPACE__ . '\Controller\Permission'  => PermissionController::class,
        __NAMESPACE__ . '\Controller\Rbac'        => Controller\RbacController::class,
        __NAMESPACE__ . '\Controller\Profile'     => Controller\ProfileController::class,
        __NAMESPACE__ . '\Controller\Diagnostics' => Controller\DiagnosticsController::class,
        'ZFTool\Controller\Diagnostics'           => __NAMESPACE__ . '\Controller\Diagnostics',
    ],
    'factories'  => [
        UserController::class        => AbstractActionControllerFactory::class,
        RoleController::class        => AbstractActionControllerFactory::class,
        PermissionController::class  => AbstractActionControllerFactory::class,
        RbacController::class        => RbacControllerFactory::class,
        ProfileController::class     => ProfileControllerFactory::class,
        DiagnosticsController::class => DiagnosticsControllerFactory::class,
    ],
    'invokables' => [
        __NAMESPACE__ . '\Controller\Index'   => IndexController::class,
        __NAMESPACE__ . '\Controller\Console' => ConsoleController::class,
    ],
];
