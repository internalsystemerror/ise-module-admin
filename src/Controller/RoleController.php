<?php

namespace Ise\Admin\Controller;

use Ise\Admin\Service\RoleService;

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
    protected static $basePermission = 'admin.rbac.roles';

    /**
     * @var string
     */
    protected static $entityType = 'role';
     
    /**
     * {@inheritDoc}
     */
    public function editAction()
    {
        return parent::editAction('ise/admin/role/edit');
    }
}
