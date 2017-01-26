<?php

namespace Ise\Admin\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use ZfcRbac\Service\AuthorizationService;

class AuthenticatedServiceFactory implements FactoryInterface
{

    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new $requestedName(
            $container,
            $container->get($requestedName::getMapperClass()),
            $container->get(AuthorizationService::class)
        );
    }
}
