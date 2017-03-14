<?php

namespace Ise\Admin;

return [
    'aliases'    => [
        __NAMESPACE__ . '\Controller\Rbac'        => Controller\RbacController::class,
        __NAMESPACE__ . '\Controller\Profile'     => Controller\ProfileController::class,
    ],
    'factories'  => [
        Controller\RbacController::class        => Controller\Factory\RbacControllerFactory::class,
        Controller\ProfileController::class     => Controller\Factory\ProfileControllerFactory::class,
    ],
    'invokables' => [
        __NAMESPACE__ . '\Controller\Admin'   => Controller\AdminController::class,
        __NAMESPACE__ . '\Controller\Index'   => Controller\IndexController::class,
    ],
];
