<?php

namespace Ise\Admin\Controller\Factory;

use Interop\Container\ContainerInterface;
use Ise\Bread\ServiceManager\BreadManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RbacControllerFactory implements FactoryInterface
{
    
    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $breadManager = $container->get(BreadManager::class);
        return new $requestedName(
            $breadManager->getService('Ise\Admin\Service\RoleService'),
            $breadManager->getService('Ise\Admin\Service\PermissionService')
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
