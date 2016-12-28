<?php

namespace Ise\Admin\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RbacControllerFactory implements FactoryInterface
{
    
    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // Load services
        $serviceLocator    = $container->getServiceLocator();
        $roleService       = $serviceLocator->get('Ise\Admin\Service\Role');
        $permissionService = $serviceLocator->get('Ise\Admin\Service\Permission');
        
        return new $requestedName($roleService, $permissionService);
    }
    
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator, $name = null, $requestedName = null)
    {
        return $this($serviceLocator, $requestedName);
    }
}
