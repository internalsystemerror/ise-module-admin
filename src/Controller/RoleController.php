<?php

namespace Ise\Admin\Controller;

use Ise\Bread\EventManager\BreadEvent;

class RoleController extends AbstractRbacController
{

    /**
     * {@inheritDoc}
     */
    public function updatePermanentEntity(BreadEvent $event)
    {
        if ($event->getEntity()->isPermanent()) {
            $event->getForm()->setValidationGroup(['description', 'users']);
        }
    }
}
