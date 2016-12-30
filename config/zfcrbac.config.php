<?php

namespace Ise\Admin;

use Ise\Admin\Assertion\IsCurrentUserAssertion;
use Ise\Admin\Assertion\NotCurrentUserAssertion;
use Ise\Admin\Entity\Role;

return [
    'assertion_manager'     => [
        'aliases'   => [
//            'notCurrentUser' => NotCurrentUserAssertion::class,
        ],
        'factories' => [
        ],
    ],
    'assertion_map'         => [
        'admin.users.edit'    => IsCurrentUserAssertion::class,
        'admin.users.delete'  => NotCurrentUserAssertion::class,
        'admin.users.enable'  => NotCurrentUserAssertion::class,
        'admin.users.disable' => NotCurrentUserAssertion::class,
        'admin.users.ban'     => NotCurrentUserAssertion::class,
        'admin.users.unban'   => NotCurrentUserAssertion::class,
    ],
    'redirect_strategy'     => [
        'redirect_when_connected'        => false,
        'redirect_to_route_connected'    => 'admin',
        'redirect_to_route_disconnected' => 'zfcuser/login',
        'append_previous_uri'            => true,
        'previous_uri_query_key'         => 'redirectTo',
    ],
    'unauthorized_strategy' => [
        'template' => 'error/403'
    ],
    'guards'                => [
        'ZfcRbac\Guard\RouteGuard' => [
            'zfcuser/login'    => ['guest'],
            'zfcuser/register' => ['guest'],
            'zfcuser'          => ['member'],
            'zfcuser/*'        => ['member'],
            'admin'            => ['member'],
            'admin/*'          => ['member'],
            'admin/rbac'       => ['admin'],
            'admin/users'      => ['admin'],
        ],
    ],
    'role_provider'         => [
        'ZfcRbac\Role\ObjectRepositoryRoleProvider' => [
            'object_manager'     => 'doctrine.entitymanager.orm_default',
            'class_name'         => Role::class,
            'role_name_property' => 'name',
        ],
    ],
];
