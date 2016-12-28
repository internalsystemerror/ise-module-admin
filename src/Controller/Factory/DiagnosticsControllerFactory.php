<?php

namespace Ise\Admin\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DiagnosticsControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $serviceLocator = $container->getServiceLocator();
        $console        = $serviceLocator->get('console');
        $config         = $serviceLocator->get('Configuration');
        $moduleManager  = $serviceLocator->get('ModuleManager');
        
        return new $requestedName($console, $config, $moduleManager, $serviceLocator);
    }
    
    public function createService(ServiceLocatorInterface $serviceLocator, $name = null, $requestedName = null)
    {
        return $this($serviceLocator, $requestedName);
    }
}
