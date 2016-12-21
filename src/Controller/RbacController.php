<?php

namespace IseAdmin\Controller;

use IseAdmin\Service\RoleService;
use IseAdmin\Service\PermissionService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class RbacController extends AbstractActionController
{
    
    /**
     * @var RoleService
     */
    protected $roleService;
    
    /**
     * @var PermissionService
     */
    protected $permissionService;
    
    /**
     * Constructor
     *
     * @param RoleService       $roleService
     * @param PermissionService $permissionService
     */
    public function __construct(RoleService $roleService, PermissionService $permissionService)
    {
        $this->roleService       = $roleService;
        $this->permissionService = $permissionService;
    }

    /**
     * {@inheritDoc}
     */
    public function indexAction()
    {
        // Return view
        return new ViewModel([
            'roles'       => $this->roleService->browse(),
            'permissions' => $this->permissionService->browse(),
        ]);
    }
}
