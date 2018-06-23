<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Admin\Listener;

use Zend\EventManager\SharedEventManagerInterface;
use Zend\Mvc\Application;
use Zend\Mvc\MvcEvent;
use Zend\View\Helper\Navigation\AbstractHelper;
use ZfcRbac\Service\AuthorizationService;

class RbacNavigationListener
{

    /**
     * @var array
     */
    protected $listeners = [];

    /**
     * {@inheritDoc}
     */
    public function attachShared(SharedEventManagerInterface $eventManager): void
    {
        $this->listeners[] = $eventManager->attach(
            AbstractHelper::class,
            'isAllowed',
            [$this, 'accept']
        );
    }

    /**
     * {@inheritDoc}
     */
    public function detachShared(SharedEventManagerInterface $eventManager): void
    {
        foreach ($this->listeners as $index => $listener) {
            if ($eventManager->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    /**
     * Check navigation page for permission
     *
     * @param  MvcEvent $event
     *
     * @return bool
     */
    public function accept(MvcEvent $event): bool
    {
        $application = $event->getTarget();
        if (!$application instanceof Application) {
            return true;
        }

        // Set variables
        $event->stopPropagation();
        $accepted = true;
        $page     = $event->getParam('page');

        /** @var AuthorizationService $rbac */
        $rbac = $application->getServiceManager()->get(AuthorizationService::class);

        // Check permission
        $permission = $page->getPermission();
        if ($permission) {
            $accepted = $rbac->isGranted($permission);
        }

        return $accepted;
    }
}
