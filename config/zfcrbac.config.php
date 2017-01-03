<?php

namespace Ise\Admin;

return [
    'assertion_map'         => [
        'admin.users.edit'    => Assertion\IsCurrentUserAssertion::class,
        'admin.users.delete'  => Assertion\NotCurrentUserAssertion::class,
        'admin.users.enable'  => Assertion\NotCurrentUserAssertion::class,
        'admin.users.disable' => Assertion\NotCurrentUserAssertion::class,
        'admin.users.ban'     => Assertion\NotCurrentUserAssertion::class,
        'admin.users.unban'   => Assertion\NotCurrentUserAssertion::class,
    ],
    'redirect_strategy'     => [
        'redirect_when_connected'        => false,
        'redirect_to_route_connected'    => 'admin',
        'redirect_to_route_disconnected' => 'zfcuser/login',
        'append_previous_uri'            => true,
        'previous_uri_query_key'         => 'redirect',
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
            'class_name'         => Entity\Role::class,
            'role_name_property' => 'name',
        ],
    ],
];
