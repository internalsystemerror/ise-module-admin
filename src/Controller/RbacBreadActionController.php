<?php

namespace Ise\Admin\Controller;

use Ise\Bread\Router\Http\Bread;

class RbacBreadActionController extends AdminBreadActionController
{

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
    public function editAction()
    {
        // PRG wrapper
        $prg = $this->prg();
        if ($prg instanceof ResponseInterface) {
            return $prg;
        }

        // Check access
        $entity = $this->getEntity();
        if (!$entity) {
            return $this->notFoundAction();
        }
        $this->checkPermission(Bread::ACTION_UPDATE, $entity);

        // Setup form
        $form = $this->service->getForm(Bread::FORM_UPDATE);
        if ($entity->isPermanent()) {
            $form->setValidationGroup(['description']);
        }

        // Perform action
        $form->bind($entity);
        $action = $this->performAction(Bread::ACTION_UPDATE, $prg);
        if ($action) {
            return $action;
        }

        // Return view
        $this->setupFormForView($form);
        return $this->createActionViewModel(Bread::ACTION_UPDATE, [
            'entity' => $entity,
            'form'   => $form,
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function deleteAction()
    {
        // PRG wrapper
        $prg = $this->prg();
        if ($prg instanceof ResponseInterface) {
            return $prg;
        }
        
        // Check access
        $entity = $this->getEntity();
        if (!$entity || $entity->isPermanent()) {
            return $this->notFoundAction();
        }
        $this->checkPermission(Bread::ACTION_DELETE, $entity);
        
        // Setup form
        $form = $this->service->getForm(Bread::FORM_DIALOG);
        $form->bind($entity);
        
        // Perform action
        $action = $this->performAction(Bread::ACTION_DELETE, $prg);
        if ($action) {
            return $action;
        }
        
        // Return view
        $this->setupFormForDialogue($form);
        return $this->createDialogueViewModelWrapper(
            Bread::ACTION_DELETE,
            $form,
            $entity
        );
    }
}
