<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Admin\Controller\Factory;

use Interop\Container\ContainerInterface;
use Ise\Admin\Controller\ProfileController;
use Ise\Admin\Service\UserService;
use Ise\Bread\ServiceManager\BreadManager;
use Zend\ServiceManager\Factory\FactoryInterface;

class ProfileControllerFactory implements FactoryInterface
{

    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): ProfileController
    {
        return new $requestedName($container->get(BreadManager::class)->getService(UserService::class));
    }
}
