<?php

namespace Ise\Admin\Controller;

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
    protected static $basePermission = 'admin.rbac.permissions';

    /**
     * @var string
     */
    protected static $entityType = 'permission';

    /**
     * {@inheritDoc}
     */
    public function editAction()
    {
        return parent::editAction('ise/admin/permission/edit');
    }
}
