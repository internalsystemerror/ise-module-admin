<?php

namespace Ise\Admin;

use Ise\Admin\Navigation\Service\UserMenuNavigationFactory;
use Ise\Bread\Factory\DoctrineOrmMapperFactory;
use Zend\Authentication\AuthenticationService;
use Zend\Db\Adapter\Adapter;
use Zend\Navigation\Service\DefaultNavigationFactory;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'aliases'            => [
        AuthenticationService::class          => 'zfcuser_auth_service',
        'zfcuser_zend_db_adapter'             => Adapter::class,
        /**
         * BREAD Mappers
         */
        __NAMESPACE__ . '\Mapper\User'        => Mapper\DoctrineOrm\UserMapper::class,
        __NAMESPACE__ . '\Mapper\Role'        => Mapper\DoctrineOrm\RoleMapper::class,
        __NAMESPACE__ . '\Mapper\Permission'  => Mapper\DoctrineOrm\PermissionMapper::class,
        /**
         * BREAD Services
         */
        __NAMESPACE__ . '\Service\User'       => Service\UserService::class,
        __NAMESPACE__ . '\Service\Role'       => Service\RoleService::class,
        __NAMESPACE__ . '\Service\Permission' => Service\PermissionService::class,
    ],
    'factories'          => [
        'default_navigation'                       => DefaultNavigationFactory::class,
        'user_menu_navigation'                     => UserMenuNavigationFactory::class,
        /**
         * Listeners
         */
        Listener\AdminRouteListener::class         => InvokableFactory::class,
        Listener\RbacNavigationListener::class     => InvokableFactory::class,
        /**
         * BREAD Mappers
         */
        Mapper\DoctrineOrm\UserMapper::class       => DoctrineOrmMapperFactory::class,
        Mapper\DoctrineOrm\RoleMapper::class       => DoctrineOrmMapperFactory::class,
        Mapper\DoctrineOrm\PermissionMapper::class => DoctrineOrmMapperFactory::class,
    ],
];
