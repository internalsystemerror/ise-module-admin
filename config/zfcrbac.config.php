<?php

namespace IseAdmin;

use IseAdmin\Assertion\NotCurrentUserAssertion;
use IseAdmin\Entity\Role;

return [
    'assertion_manager' => [
        'factories' => [
            'notCurrentUser' => NotCurrentUserAssertion::class,
        ],
    ],
    'assertion_map'     => [
        '' => 'notCurrentUser',
    ],
    'redirect_strategy' => [
        'redirect_when_connected'        => false,
        'redirect_to_route_connected'    => 'admin/index',
        'redirect_to_route_disconnected' => 'zfcuser/login',
        'append_previous_uri'            => true,
        'previous_uri_query_key'         => 'redirectTo',
    ],
    'unauthorized_strategy' => [
        'template' => 'error/403'
    ],
    'guards'            => [
        'ZfcRbac\Guard\RouteGuard' => [
            'zfcuser/login'    => ['guest'],
            'zfcuser/register' => ['guest'],
            'zfcuser/*'        => ['member'],
            'admin/*'          => ['member'],
            'admin/rbac'       => ['admin'],
            'admin/users'      => ['admin'],
        ],
    ],
    'role_provider'     => [
        'ZfcRbac\Role\ObjectRepositoryRoleProvider' => [
            'object_manager'     => 'doctrine.entitymanager.orm_default',
            'class_name'         => Role::class,
            'role_name_property' => 'name',
        ],
    ],
];
