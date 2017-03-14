<?php

namespace Ise\Admin\Controller;

use Ise\Bread\Service\BreadService;
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
     * @param BreadService $roleService
     * @param BreadService $permissionService
     */
    public function __construct(BreadService $roleService, BreadService $permissionService)
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
