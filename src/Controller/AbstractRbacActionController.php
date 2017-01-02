<?php

namespace Ise\Admin\Controller;

use Ise\Bread\Controller\AbstractActionController;
use Ise\Bread\Router\Http\BreadRouteStack;
use ZfcRbac\Exception\UnauthorizedException;

class AbstractRbacActionController extends AbstractActionController
{

    /**
     * {@inheritDoc}
     */
    public function browseAction()
    {
        // Check for access permission
        if (!$this->isGranted($this->basePermission)) {
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
        $id     = (string) $this->params($this->identifier, '');
        $entity = $this->service->read($id);
        if (!$entity || $entity->isPermanent()) {
            return $this->notFoundAction();
        }

        return $this->bread(BreadRouteStack::ACTION_DELETE);
    }

    /**
     * {@inheritDoc}
     */
    protected function createViewModel($actionType, array $parameters = [], $viewTemplate = null)
    {
        switch ($actionType) {
            case BreadRouteStack::ACTION_ENABLE:
            case BreadRouteStack::ACTION_DISABLE:
                if (!$viewTemplate) {
                    $viewTemplate = 'ise/admin/rbac/' . $actionType;
                }
                $parameters = array_merge([
                    'indexRoute' => 'admin/rbac'
                    ], $parameters);
                break;
        }
        return parent::createViewModel($actionType, $parameters, $viewTemplate);
    }
}
