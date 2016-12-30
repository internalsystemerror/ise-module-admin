<?php

namespace Ise\Admin;

use Ise\Admin\Mapper\DoctrineOrm\UserMapper;
use Ise\Admin\Mapper\DoctrineOrm\RoleMapper;
use Ise\Admin\Mapper\DoctrineOrm\PermissionMapper;
use Ise\Admin\Navigation\Service\UserMenuNavigationFactory;
use Ise\Admin\Service\UserService;
use Ise\Admin\Service\RoleService;
use Ise\Admin\Service\PermissionService;
use Ise\Bread\Factory\DoctrineOrmMapperFactory;
use Zend\Authentication\AuthenticationService;
use Zend\Db\Adapter\Adapter;
use Zend\Navigation\Service\DefaultNavigationFactory;
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
        'default_navigation'    => DefaultNavigationFactory::class,
        'user_menu_navigation'  => UserMenuNavigationFactory::class,
        UserMapper::class       => DoctrineOrmMapperFactory::class,
        RoleMapper::class       => DoctrineOrmMapperFactory::class,
        PermissionMapper::class => DoctrineOrmMapperFactory::class,
    ],
    'initializers' => [
        AuthorizationServiceInitializer::class,
    ],
];
