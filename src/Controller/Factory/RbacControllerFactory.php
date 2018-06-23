<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Admin\Controller\Factory;

use Interop\Container\ContainerInterface;
use Ise\Admin\Controller\RbacController;
use Ise\Admin\Entity\Permission;
use Ise\Admin\Entity\Role;
use Ise\Bread\ServiceManager\BreadManager;
use Zend\ServiceManager\Factory\FactoryInterface;

class RbacControllerFactory implements FactoryInterface
{

    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): RbacController
    {
        $breadManager = $container->get(BreadManager::class);
        return new $requestedName(
            $breadManager->getServiceFromEntityClass(Role::class),
            $breadManager->getServiceFromEntityClass(Permission::class)
        );
    }
}
