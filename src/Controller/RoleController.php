<?php

namespace Ise\Admin\Controller;

use Ise\Admin\Entity\Permission;
use Ise\Admin\Entity\Role;
use Ise\Bread\Router\Http\Bread;
use Ise\Admin\Service\RoleService;
use Zend\Form\Form;
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
    protected $basePermission = 'admin.rbac.roles';

    /**
     * @var string
     */
    protected $entityType = 'role';

    /**
     * @var Role
     */
    protected $currentRole;

    /**
     * Edit action
     *
     * @return ViewModel
     */
    public function editAction()
    {
        // PRG wrapper
        $prg = $this->prg();
        if ($prg instanceof ResponseInterface) {
            return $prg;
        }
        
        // Check access
        $role = $this->getEntity();
        if (!$role) {
            return $this->notFoundAction();
        }
        $this->checkPermission(Bread::ACTION_UPDATE, $role);
        
        // Setup form
        $form = $this->service->getForm(Bread::ACTION_UPDATE);
        $form->bind($role);
        
        // Perform action
        $action = $this->performAction(Bread::ACTION_UPDATE, $prg);
        if ($action) {
            return $action;
        }

        if ($role->isPermanent()) {
            $this->setupPermanentRole($form, $role);
        }

        // Return view
        $this->setupFormForView($form);
        return $this->createActionViewModel(Bread::ACTION_UPDATE, [
                'entity' => $role,
                'form'   => $form,
                ], 'ise/admin/role/edit');
    }

    /**
     * Generate option label
     * 
     * @param Permission $permission
     * @return string
     */
    public function optionLabelGenerator(Permission $permission)
    {
        $label = $permission->getName() . ' - ' . $permission->getDescription();
        if ($permission->isPermanent()) {
            $label = '[PERMANENT] ' . $label;
        }
        if ($this->roleInheritsPermission($this->currentRole, $permission)) {
            $label .= ' (Inherited)';
        }
        return $label;
    }

    /**
     * Generate checked attribute for option
     * 
     * @param Permission $permission
     * @return string
     */
    public function optionCheckedAttributeGenerator(Permission $permission)
    {
        if ($this->roleInheritsPermission($this->currentRole, $permission)) {
            return 'checked';
        }
        return null;
    }

    /**
     * Generate disabled attribute for option
     * 
     * @param Permission $permission
     * @return string
     */
    public function optionDisabledAttributeGenerator(Permission $permission)
    {
        if ($permission->isPermanent() || $this->roleInheritsPermission($this->currentRole, $permission)) {
            return 'disabled';
        }
        return null;
    }

    /**
     * Setup permanent role
     * 
     * @param Form $form
     * @param Role $role
     */
    protected function setupPermanentRole(Form $form, Role $role)
    {
        // Set current role
        $this->currentRole = $role;
        
        // Get elements
        $name        = $form->get('name');
        $parent      = $form->get('parent');
        $permissions = $form->get('permissions');

        // Set up attributes
        $name->setAttribute('disabled', 'disabled');
        $parent->setAttribute('disabled', 'disabled');
        $permissions->setOption('label_generator', [$this, 'optionLabelGenerator']);
        $permissions->setOption('option_attributes', [
            'checked'  => [$this, 'optionCheckedAttributeGenerator'],
            'disabled' => [$this, 'optionDisabledAttributeGenerator'],
        ]);
    }

    /**
     * Does role inherit the permission?
     *
     * @param Role $role
     * @param Permission $permission
     * @return boolean
     */
    protected function roleInheritsPermission(Role $role, Permission $permission)
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
