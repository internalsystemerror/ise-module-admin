<?php

namespace Ise\Admin\Controller;

use Ise\Bread\Router\Http\BreadRouteStack;
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
    protected $indexRoute = 'admin/permissions';

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
        return $this->bread(BreadRouteStack::ACTION_UPDATE, 'ise/admin/permission/' . BreadRouteStack::ACTION_UPDATE);
    }
}
