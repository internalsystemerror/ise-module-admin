<?php

namespace Ise\Admin\Controller;

use Ise\Bread\EventManager\BreadEvent;

abstract class AbstractRbacController extends AdminActionController
{

    /**
     * {@inheritDoc}
     */
    public function browseAction()
    {
        return $this->redirectBrowse();
    }

    /**
     * Check if updating a permanent entity
     *
     * @param BreadEvent $event
     */
    abstract public function updatePermanentEntity(BreadEvent $event);
    
    /**
     * {@inheritDoc}
     */
    public function checkDialogueNotAllowed(BreadEvent $event)
    {
        switch ($event->getAction()) {
            case BreadEvent::ACTION_DELETE:
                if (!$event->getEntity()->isPermanent()) {
                    return;
                }
                // Set warning message
                $this->flashMessenger()->addWarningMessage(sprintf(
                    'That %s is permanent and cannot be deleted.',
                    $this->entityTitle
                ));
                return $this->redirect()->toRoute($this->indexRoute);
        }

        return parent::checkDialogueNotAllowed($event);
    }

    /**
     * {@inheritDoc}
     */
    protected function attachDefaultBreadListeners()
    {
        parent::attachDefaultBreadListeners();
        $this->breadEventManager->attach(BreadEvent::EVENT_UPDATE, [$this, 'updatePermanentEntity'], 590);
    }
}
