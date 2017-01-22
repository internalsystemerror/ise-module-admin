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
     * {@inheritDoc}
     */
    public function editAction()
    {
        
        return parent::editAction('ise/admin/permission/edit');
    }
}
