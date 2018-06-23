<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Admin\Controller;

use Ise\Admin\Entity\AbstractRbacEntity;
use Ise\Bread\EventManager\BreadEvent;
use Zend\Http\Response;

abstract class AbstractRbacController extends AdminController
{

    /**
     * {@inheritDoc}
     */
    public function browseAction(): Response
    {
        return $this->redirectBrowse();
    }

    /**
     * Check if updating a permanent entity
     *
     * @param BreadEvent $event
     *
     * @return void
     */
    abstract public function updatePermanentEntity(BreadEvent $event): void;

    /**
     * {@inheritDoc}
     */
    public function checkDialogueNotAllowed(BreadEvent $event): ?Response
    {
        switch ($event->getAction()) {
            case BreadEvent::ACTION_DELETE:
                $entity = $event->getEntity();
                if ($entity instanceof AbstractRbacEntity && !$entity->isPermanent()) {
                    return null;
                }
                // Set warning message
                $this->flashMessenger()->addWarningMessage(sprintf(
                    'That %s is permanent and cannot be deleted.',
                    $this->entityTitle
                ));
                return $this->redirect()->toRoute($this->indexRoute);
        }

        return parent::checkDialogNotAllowed($event);
    }

    /**
     * {@inheritDoc}
     */
    protected function attachDefaultBreadListeners(): void
    {
        parent::attachDefaultBreadListeners();
        $this->breadEventManager->attach(BreadEvent::EVENT_UPDATE, [$this, 'updatePermanentEntity'], 590);
    }
}
