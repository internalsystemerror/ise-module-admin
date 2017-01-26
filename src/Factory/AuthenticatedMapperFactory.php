<?php

namespace Ise\Admin\Factory;

use Interop\Container\ContainerInterface;
use Ise\Bread\Factory\DoctrineOrmMapperFactory;
use ZfcRbac\Service\AuthorizationService;

class AuthenticatedMapperFactory extends DoctrineOrmMapperFactory
{

    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new $requestedName(
            $container->get(EntityManager::class),
            $container->get(AuthorizationService::class)
        );
    }
}
