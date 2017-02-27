<?php

namespace Ise\Admin\Controller;

use Ise\Bread\Controller\BreadActionController;
use ZfcRbac\Exception\UnauthorizedException;

/**
 * @SuppressWarnings(PHPMD.ShortVariableName)
 */
class AdminBreadActionController extends BreadActionController
{
    
    /**
     * {@inheritDoc}
     * @throws UnauthorizedException
     */
    protected function checkPermission($actionType = null, $context = null)
    {
        $permission = $this->basePermission;
        if ($actionType) {
            $permission .= '.' . $actionType;
        }
        
        if (!$this->isGranted($permission, $context)) {
            throw new UnauthorizedException;
        }
    }
}
