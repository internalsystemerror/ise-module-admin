<?php

namespace IseAdmin\Listener;

use Zend\EventManager\SharedEventManagerInterface;
use Zend\EventManager\SharedListenerAggregateInterface;
use Zend\EventManager\EventInterface;
use Zend\Navigation\Page\Mvc;

class RbacNavigationListener implements SharedListenerAggregateInterface
{

    /**
     * @var array
     */
    protected $listeners = [];

    /**
     * {@inheritDoc}
     */
    public function attachShared(SharedEventManagerInterface $eventManager)
    {
        $this->listeners[] = $eventManager->attach(
            'Zend\View\Helper\Navigation\AbstractHelper',
            'isAllowed',
            [$this, 'accept']
        );
    }

    /**
     * {@inheritDoc}
     */
    public function detachShared(SharedEventManagerInterface $eventManager)
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
     * @param  EventInterface $event
     * @return boolean
     */
    public function accept(EventInterface $event)
    {
        // Set variables
        $event->stopPropagation();
        $accepted = true;
        $page     = $event->getParam('page');
        $rbac     = $event->getTarget()
            ->getServiceLocator()
            ->get('ZfcRbac\Service\AuthorizationService');

        // Check permission
        $permission = $page->getPermission();
        if ($permission) {
            $accepted = $rbac->isGranted($permission);
        }

        return $accepted;
    }
}
