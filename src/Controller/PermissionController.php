<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Admin\Controller;

use Ise\Admin\Entity\Permission;
use Ise\Bread\EventManager\BreadEvent;
use Zend\Form\Form;

class PermissionController extends AbstractRbacController
{

    /**
     * {@inheritDoc}
     */
    public function updatePermanentEntity(BreadEvent $event): void
    {
        $entity = $event->getEntity();
        $form   = $event->getForm();
        if ($entity instanceof Permission && $entity->isPermanent() && $form instanceof Form) {
            $form->setValidationGroup(['description', 'roles']);
        }
    }
}
