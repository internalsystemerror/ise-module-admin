<?php

namespace Ise\Admin;

use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\DependencyIndicatorInterface;
use ZfcRbac\View\Strategy\RedirectStrategy;
use ZfcRbac\View\Strategy\UnauthorizedStrategy;

class Module implements
    BootstrapListenerInterface,
    ConfigProviderInterface,
    DependencyIndicatorInterface
{

    /**
     * {@inheritDoc}
     */
    public function onBootstrap(EventInterface $event)
    {
        // Get event manager
        $target         = $event->getTarget();
        $eventManager   = $target->getEventManager();
        $serviceManager = $target->getServiceManager();

        // Attach listeners
        $adminRouteListener = $serviceManager->get(Listener\AdminRouteListener::class);
        $adminRouteListener->attach($eventManager);
        
        $rbacNavigationListener = $serviceManager->get(Listener\RbacNavigationListener::class);
        $rbacNavigationListener->attachShared($eventManager->getSharedManager());

        // Attach ZfcRbac redirect strategy
        $redirectStrategy = $serviceManager->get(RedirectStrategy::class);
        $redirectStrategy->attach($eventManager);
        
        // Attach ZfcRbac unauthorised strategy
        $unauthorisedStrategy = $serviceManager->get(UnauthorizedStrategy::class);
        $unauthorisedStrategy->attach($eventManager);
    }

    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return include realpath(__DIR__ . '/../config/module.config.php');
    }

    /**
     * {@inheritDoc}
     */
    public function getModuleDependencies()
    {
        return [
            'Ise\Bootstrap',
            'Ise\Bread',
            'ZfcBase',
            'ZfcRbac',
            'ZfcUser',
            'ZfcUserDoctrineORM',
        ];
    }
}
