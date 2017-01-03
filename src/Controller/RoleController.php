<?php

namespace Ise\Admin\Controller;

use Ise\Admin\Entity\Permission;
use Ise\Admin\Entity\Role;
use Ise\Bread\Router\Http\BreadRouteStack;
use Ise\Admin\Service\RoleService;
use Zend\View\Model\ViewModel;

/**
 * @SuppressWarnings(PHPMD.ShortVariableName)
 */
class RoleController extends AbstractRbacActionController
{
    
    /**
     * @var string
     */
    protected static $serviceClass = RoleService::class;

    /**
     * @var string
     */
    protected $indexRoute = 'admin/roles';

    /**
     * @var string
     */
    protected $basePermission = 'admin.rbac.roles';

    /**
     * @var string
     */
    protected $entityType = 'role';

    /**
     * Edit action
     *
     * @return ViewModel
     */
    public function editAction()
    {
        // Set variables
        $viewModel = $this->bread(BreadRouteStack::ACTION_UPDATE, 'ise/admin/role/edit');
        if (!$viewModel instanceof ViewModel) {
            return $viewModel;
        }
        $entity = $viewModel->getVariable('entity');
        $form   = $viewModel->getVariable('form');

        // Check for permanency
        if ($entity->isPermanent()) {
            // Get elements
            $name        = $form->get('name');
            $parent      = $form->get('parent');
            $permissions = $form->get('permissions');

            // Set up attributes
            $name->setAttribute('disabled', 'disabled');
            $parent->setAttribute('disabled', 'disabled');
            $permissions->setOption('label_generator', function (Permission $permission) use ($entity) {
                $label = $permission->getName() . ' - ' . $permission->getDescription();
                if ($permission->isPermanent()) {
                    $label = '[PERMANENT] ' . $label;
                }
                if ($this->roleInheritsPermission($entity, $permission)) {
                    $label .= ' (Inherited)';
                }
                return $label;
            });
            $permissions->setOption('option_attributes', [
                'checked' => function (Permission $permission) use ($entity) {
                    if ($this->roleInheritsPermission($entity, $permission)) {
                        return 'checked';
                    }
                    return null;
                },
                'disabled' => function (Permission $permission) use ($entity) {
                    if ($permission->isPermanent() || $this->roleInheritsPermission($entity, $permission)) {
                        return 'disabled';
                    }
                    return null;
                },
            ]);
        }

        // Set up cancel button
        $cancel = $form->get('buttons')->get('cancel');
        $cancel->setAttribute('href', $this->url()->fromRoute($this->indexRoute));

        return $viewModel;
    }

    /**
     * Does role inherit the permission?
     *
     * @param Role $role
     * @param Permission $permission
     * @return boolean
     */
    private function roleInheritsPermission(Role $role, Permission $permission)
    {
        foreach ($role->getChildren() as $childRole) {
            if ($childRole->hasPermission($permission)) {
                return true;
            }
            if ($this->roleInheritsPermission($childRole, $permission)) {
                return true;
            }
        }
        return false;
    }
}
