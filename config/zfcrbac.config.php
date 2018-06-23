<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Admin;

return [
    'assertion_map'         => [
        'admin.user.edit'    => Assertion\IsCurrentUserAssertion::class,
        'admin.user.delete'  => Assertion\NotCurrentUserAssertion::class,
        'admin.user.enable'  => Assertion\NotCurrentUserAssertion::class,
        'admin.user.disable' => Assertion\NotCurrentUserAssertion::class,
        'admin.user.ban'     => Assertion\NotCurrentUserAssertion::class,
        'admin.user.unban'   => Assertion\NotCurrentUserAssertion::class,
    ],
    'redirect_strategy'     => [
        'redirect_when_connected'        => true,
        'redirect_to_route_connected'    => 'zfcuser/logout',
        'redirect_to_route_disconnected' => 'zfcuser/login',
        'append_previous_uri'            => true,
        'previous_uri_query_key'         => 'redirect',
    ],
    'unauthorized_strategy' => [
        'template' => 'error/403',
    ],
    'guards'                => [
        'ZfcRbac\Guard\RouteGuard' => [
            'zfcuser/logout'   => ['guest'],
            'zfcuser/login'    => ['guest'],
            'zfcuser/register' => ['guest'],
            'zfcuser'          => ['member'],
            'zfcuser/*'        => ['member'],
            'admin'            => ['member'],
            'admin/*'          => ['member'],
            'admin/rbac'       => ['admin'],
            'admin/user'       => ['admin'],
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
