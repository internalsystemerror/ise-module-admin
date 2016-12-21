<?php

namespace IseAdmin\Controller;

use IseBread\Controller\AbstractActionController;
use ZfcRbac\Exception\UnauthorizedException;

class AbstractRbacActionController extends AbstractActionController
{

    /**
     * {@inheritDoc}
     */
    public function browseAction()
    {
        // Check for access permission
        if (!$this->isGranted($this->basePermission . '.browse')) {
            throw new UnauthorizedException();
        }
        return $this->redirect()->toRoute('admin/rbac');
    }

    /**
     * {@inheritDoc}
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function deleteAction()
    {
        // Load entity
        $id      = (int) $this->params($this->identifier, 0);
        $service = $this->getService();
        $entity  = $service->read($id);
        if (!$entity || $entity->isPermanent()) {
            return $this->notFoundAction();
        }

        return $this->bread('delete');
    }

    /**
     * {@inheritDoc}
     */
    protected function createViewModel($actionType, array $parameters = [], $viewTemplate = null)
    {
        switch ($actionType) {
            case 'enable':
            case 'disable':
                if (!$viewTemplate) {
                    $viewTemplate = 'ise-admin/rbac/' . $actionType;
                }
                $parameters = array_merge([
                    'indexRoute' => 'admin/rbac'
                    ], $parameters);
                break;
        }
        return parent::createViewModel($actionType, $parameters, $viewTemplate);
    }
}
