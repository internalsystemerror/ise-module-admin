<?php

namespace Ise\Admin\Controller;

use Ise\Bread\Router\Http\Bread;
use Ise\Admin\Service\PermissionService;

/**
 * @SuppressWarnings(PHPMD.ShortVariableName)
 */
class PermissionController extends AbstractRbacActionController
{
    
    /**
     * @var string
     */
    protected static $serviceClass = PermissionService::class;

    /**
     * @var string
     */
    protected $basePermission = 'admin.rbac.permissions';

    /**
     * @var string
     */
    protected $entityType = 'permission';

    /**
     * Edit action
     *
     * @return ViewModel
     */
    public function editAction()
    {
        // Check access
        $entity = $this->getEntity();
        if (!$entity) {
            return $this->notFoundAction();
        }
        $this->checkPermission(Bread::ACTION_UPDATE, $entity);
        
        // Setup form
        $form = $this->service->getForm(Bread::ACTION_UPDATE);
        $form->bind($entity);
        
        // Perform action
        $action = $this->performAction(Bread::ACTION_UPDATE);
        if ($action) {
            return $action;
        }
        
        // Return view
        $this->setupFormForView($form);
        return $this->createActionViewModel(Bread::ACTION_UPDATE, [
            'entity' => $entity,
            'form'   => $form,
        ], 'ise/admin/permission/edit');
    }
}
