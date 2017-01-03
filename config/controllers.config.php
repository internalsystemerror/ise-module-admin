<?php

namespace Ise\Admin;

use Ise\Bread\Controller\Factory\ActionControllerFactory;

return [
    'aliases'    => [
        __NAMESPACE__ . '\Controller\User'        => Controller\UserController::class,
        __NAMESPACE__ . '\Controller\Role'        => Controller\RoleController::class,
        __NAMESPACE__ . '\Controller\Permission'  => Controller\PermissionController::class,
        __NAMESPACE__ . '\Controller\Rbac'        => Controller\RbacController::class,
        __NAMESPACE__ . '\Controller\Profile'     => Controller\ProfileController::class,
    ],
    'factories'  => [
        Controller\UserController::class        => ActionControllerFactory::class,
        Controller\RoleController::class        => ActionControllerFactory::class,
        Controller\PermissionController::class  => ActionControllerFactory::class,
        Controller\RbacController::class        => Controller\Factory\RbacControllerFactory::class,
        Controller\ProfileController::class     => Controller\Factory\ProfileControllerFactory::class,
    ],
    'invokables' => [
        __NAMESPACE__ . '\Controller\Admin'   => Controller\AdminController::class,
        __NAMESPACE__ . '\Controller\Index'   => Controller\IndexController::class,
    ],
];
