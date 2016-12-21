<?php

namespace IseAdmin;

use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\Feature\DependencyIndicatorInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

class Module implements
    BootstrapListenerInterface,
    ConfigProviderInterface,
    ControllerProviderInterface,
    DependencyIndicatorInterface,
    ServiceProviderInterface,
    ViewHelperProviderInterface
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
        $eventManager->attachAggregate(new Listener\AdminRouteListener);
        $eventManager->getSharedManager()->attachAggregate(new Listener\RbacNavigationListener);

        // Attach ZfcRbac redirect strategy
        $redirectStrategy = $serviceManager->get('ZfcRbac\View\Strategy\RedirectStrategy');
        $eventManager->attach($redirectStrategy);
        
        // Attach ZfcRbac unauthorised strategy
        $unauthorisedStrategy = $serviceManager->get('ZfcRbac\View\Strategy\UnauthorizedStrategy');
        $eventManager->attach($unauthorisedStrategy);
    }

    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    /**
     * {@inheritDoc}
     */
    public function getControllerConfig()
    {
        return include __DIR__ . '/../config/controllers.config.php';
    }

    /**
     * {@inheritDoc}
     */
    public function getServiceConfig()
    {
        return include __DIR__ . '/../config/services.config.php';
    }

    /**
     * {@inheritDoc}
     */
    public function getViewHelperConfig()
    {
        return include __DIR__ . '/../config/helpers.config.php';
    }

    /**
     * Get diagnostics
     *
     * @return array
     */
    public function getDiagnostics()
    {
        return [
            'Datatables CDN is available' => [
                'HttpService', 'cdn.datatables.net'
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getModuleDependencies()
    {
        return [
            'IseBootstrap',
            'IseBread',
            'ZfcBase',
            'ZfcRbac',
            'ZfcUser',
            'ZfcUserDoctrineORM',
        ];
    }
}
