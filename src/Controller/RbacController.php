<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Admin\Controller;

use Ise\Bread\Service\BreadService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class RbacController extends AbstractActionController
{

    /**
     * @var BreadService
     */
    protected $roleService;

    /**
     * @var BreadService
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
    public function indexAction(): ViewModel
    {
        // Return view
        return new ViewModel([
            'roles'       => $this->roleService->browse(),
            'permissions' => $this->permissionService->browse(),
        ]);
    }
}
