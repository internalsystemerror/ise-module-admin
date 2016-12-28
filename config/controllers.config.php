<?php

namespace Ise\Admin;

use Ise\Admin\Controller\ConsoleController;
use Ise\Admin\Controller\DiagnosticsController;
use Ise\Admin\Controller\IndexController;
use Ise\Admin\Controller\RbacController;
use Ise\Admin\Controller\RoleController;
use Ise\Admin\Controller\PermissionController;
use Ise\Admin\Controller\ProfileController;
use Ise\Admin\Controller\UserController;
use Ise\Admin\Controller\Factory\DiagnosticsControllerFactory;
use Ise\Admin\Controller\Factory\ProfileControllerFactory;
use Ise\Admin\Controller\Factory\RbacControllerFactory;
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
