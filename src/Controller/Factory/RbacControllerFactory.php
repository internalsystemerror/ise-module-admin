<?php

namespace Ise\Admin\Controller\Factory;

use Interop\Container\ContainerInterface;
use Ise\Admin\Service\RoleService;
use Ise\Admin\Service\PermissionService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RbacControllerFactory implements FactoryInterface
{
    
    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new $requestedName(
            $container->get(RoleService::class),
            $container->get(PermissionService::class)
        );
    }
    
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator, $name = null, $requestedName = null)
    {
        return $this($serviceLocator->getServiceLocator(), $requestedName);
    }
}
