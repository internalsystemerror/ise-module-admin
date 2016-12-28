<?php

namespace Ise\Admin\Controller;

/**
 * @SuppressWarnings(PHPMD.ShortVariableName)
 */
class PermissionController extends AbstractRbacActionController
{

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
        return $this->bread('edit', 'ise-admin/permission/edit');
    }
}
