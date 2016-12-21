<?php

namespace IseAdmin;

use IseAdmin\Mapper\DoctrineOrm\UserMapper;
use IseAdmin\Mapper\DoctrineOrm\RoleMapper;
use IseAdmin\Mapper\DoctrineOrm\PermissionMapper;
use IseAdmin\Navigation\Service\AdminNavigationFactory;
use IseAdmin\Navigation\Service\MenuNavigationFactory;
use IseAdmin\Service\UserService;
use IseAdmin\Service\RoleService;
use IseAdmin\Service\PermissionService;
use IseBread\Factory\DoctrineOrmMapperFactory;
use Zend\Authentication\AuthenticationService;
use Zend\Db\Adapter\Adapter;
use ZfcRbac\Initializer\AuthorizationServiceInitializer;

return [
    'aliases'      => [
        AuthenticationService::class          => 'zfcuser_auth_service',
        'zfcuser_zend_db_adapter'             => Adapter::class,
        __NAMESPACE__ . '\Mapper\User'        => UserMapper::class,
        __NAMESPACE__ . '\Mapper\Role'        => RoleMapper::class,
        __NAMESPACE__ . '\Mapper\Permission'  => PermissionMapper::class,
        __NAMESPACE__ . '\Service\User'       => UserService::class,
        __NAMESPACE__ . '\Service\Role'       => RoleService::class,
        __NAMESPACE__ . '\Service\Permission' => PermissionService::class,
    ],
    'factories'    => [
        'admin_navigation'      => AdminNavigationFactory::class,
        'admin_navigation_menu' => MenuNavigationFactory::class,
        UserMapper::class       => DoctrineOrmMapperFactory::class,
        RoleMapper::class       => DoctrineOrmMapperFactory::class,
        PermissionMapper::class => DoctrineOrmMapperFactory::class,
    ],
    'initializers' => [
        AuthorizationServiceInitializer::class,
    ],
];
