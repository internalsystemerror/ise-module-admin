<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Admin;

use Zend\Authentication\AuthenticationService;
use Zend\Db\Adapter\Adapter;
use Zend\Navigation\Service\DefaultNavigationFactory;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'aliases'   => [
        AuthenticationService::class => 'zfcuser_auth_service',
        'zfcuser_zend_db_adapter'    => Adapter::class,
    ],
    'factories' => [
        'default_navigation'                   => DefaultNavigationFactory::class,
        'user_menu_navigation'                 => Navigation\Service\UserMenuNavigationFactory::class,
        /**
         * Listeners
         */
        Listener\AdminRouteListener::class     => InvokableFactory::class,
        Listener\RbacNavigationListener::class => InvokableFactory::class,
    ],
];
