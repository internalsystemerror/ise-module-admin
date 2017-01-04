<?php

namespace Ise\Admin\Controller;

use Ise\Bread\Controller\AbstractActionController;
use Ise\Bread\Router\Http\BreadRouteStack;
use ZfcRbac\Exception\UnauthorizedException;

class AbstractRbacActionController extends AbstractActionController
{

    /**
     * @var string
     */
    protected $indexRoute = 'admin/rbac';

    /**
     * {@inheritDoc}
     */
    public function browseAction()
    {
        return $this->redirectBrowse();
    }

    /**
     * {@inheritDoc}
     */
    public function deleteAction()
    {
        // Check access
        $entity = $this->getEntity();
        if (!$entity || $entity->isPermanent()) {
            return $this->notFoundAction();
        }
        $this->checkPermission(BreadRouteStack::ACTION_DELETE, $entity);
        
        // Setup form
        $form = $this->service->getForm(BreadRouteStack::ACTION_DELETE);
        $form->bind($entity);
        
        // Perform action
        $action = $this->performAction(BreadRouteStack::ACTION_DELETE);
        if ($action) {
            return $action;
        }
        
        // Return view
        $this->setupFormForDialogue($form);
        return $this->createDialogueViewModelWrapper(BreadRouteStack::ACTION_DELETE, $form, $entity);
    }
    
    /**
     * {@inheritDoc}
     */
    public function enableAction()
    {
        return $this->dialogueAction(BreadRouteStack::ACTION_ENABLE, 'ise/admin/rbac/dialogue');
    }
    
    /**
     * {@inheritDoc}
     */
    public function disableAction()
    {
        return $this->dialogueAction(BreadRouteStack::ACTION_DISABLE, 'ise/admin/rbac/dialogue');
    }
}
